<?php
namespace Platform\Relation\Service;

use Kendo\Content\ContentInterface;
use Kendo\Content\PosterInterface;
use Platform\Relation\Model\Relation;
use Platform\Relation\Model\RelationItem;
use Platform\Relation\Model\RelationRequest;

/**
 * Class Platform\RelationService
 *
 * @package Core\Service
 */
class RelationService
{

    /**
     * No member ship status
     */
    const IS_EMPTY = '';

    /**
     * Is member list
     */
    const REQUEST_SENT = -1;

    /**
     * Receive membership request
     */
    const REQUEST_RECEIVED = -2;

    /**
     * @param        $viewerId
     * @param string $alias
     *
     * @return string
     */
    public function getPrivacyConditionForQuery($viewerId = null, $alias = 'f')
    {
        if (null == $viewerId) {
            $viewerId = (string)\App::authService()->getId();
        }

        return strtr("(:alias.privacy_type in (:public,:registered) OR (:alias.poster_id=:viewerId) OR (:alias.privacy_value=:viewerId) OR (:alias.privacy_value IN ( SELECT relation_id FROM :prefix_relation_item WHERE poster_id=:viewerId UNION SELECT relation_id FROM :prefix_relation WHERE parent_id=:viewerId)))", [
            ':public'     => RELATION_TYPE_ANYONE,
            ':registered' => RELATION_TYPE_REGISTERED,
            ':prefix_'    => \App::db()->getPrefix(),
            ':viewerId'   => $viewerId,
            ':alias'      => $alias,
        ]);
    }

    /**
     * @param PosterInterface $parent
     *
     * @return int
     */
    public function getMemberCount(PosterInterface $parent)
    {
        return (int)\App::table('platform_relation_item')
            ->select()
            ->where('relation_id=?', $parent->getId())
            ->where('parent_id=?', $parent->getId())
            ->count();

    }

    /**
     * @param PosterInterface $parent
     * @param array           $type
     *
     * @return array
     */
    public function getMemberIdList($parent, $type = null)
    {
        $select = \App::table('platform_relation_item')
            ->select()
            ->where('relation_id=?', $parent->getId())
            ->where('parent_id=?', $parent->getId());

        if ($type) {
            $select->where('poster_type=?', $type);
        }

        return $select->fields('poster_id');
    }

    /**
     * @return array
     */
    public function getGeneralRelationType()
    {
        return [
            RELATION_TYPE_ANYONE,
            RELATION_TYPE_REGISTERED,
            RELATION_TYPE_OWNER
        ];
    }

    /**
     * @param PosterInterface $parent
     * @param int             $relationType
     * @param string          $name
     * @param int             $itemCount
     *
     * @return \Platform\Relation\Model\Relation
     */
    public function addList(PosterInterface $parent, $relationType, $name, $itemCount = 0)
    {
        if ($relationType == RELATION_TYPE_MEMBER_OF_MEMBER) {
            // do not add this relation type.
            return $this->findList($parent, RELATION_TYPE_MEMBER, true);
        }

        $list = new Relation([
            'relation_type' => $relationType,
            'relation_name' => (string)$name,
            'parent_id'     => $parent->getId(),
            'parent_type'   => $parent->getType(),
            'item_count'    => (int)$itemCount
        ]);

        /**
         * If relation_type == RELATION_TYPE_MEMBER relation_id = parent_id
         */
        if ($relationType == RELATION_TYPE_MEMBER) {
            $list->setId($parent->getId());
        }

        $list->save();

        return $list;
    }

    /**
     * @param PosterInterface $parent
     * @param        $relationType
     * @param        $relationId
     */
    public function getList(PosterInterface $parent, $relationType, $relationId = null)
    {


    }

    /**
     * @param $relationType
     *
     * @return bool
     */
    public function isGenericRelationType($relationType)
    {
        return in_array($relationType, $this->getGeneralRelationType());
    }

    /**
     * @param PosterInterface $parent
     * @param int             $relationType
     * @param bool            $createIfNotFound
     *
     * @return Platform\Relation
     */
    public function findList(PosterInterface $parent, $relationType, $createIfNotFound = false)
    {

        if (in_array($relationType, $this->getGeneralRelationType())) {
            throw new \InvalidArgumentException("Could not add build-in relation [$relationType]");
        }

        if ($relationType >= RELATION_TYPE_CUSTOM) {
            throw new \InvalidArgumentException("Relation type must be less than " . RELATION_TYPE_CUSTOM);
        }

        /**
         * DO NOT CREATE/ UPDATE For RELATION_TYPE_MEMBER_OF_MEMBER.
         */
        if ($relationType == RELATION_TYPE_MEMBER_OF_MEMBER) {
            $relationType = RELATION_TYPE_MEMBER;
        }

        $relation = \App::table('platform_relation')
            ->select()
            ->where('parent_id=?', $parent->getId())
            ->where('relation_type=?', $relationType)
            ->one();

        if (null == $relation && $createIfNotFound) {
            $relation = $this->addList($parent, $relationType, '', 0);
        }

        return $relation;
    }

    /**
     * @param PosterInterface $parent
     * @param PosterInterface $poster
     * @param null            $relationId
     */
    private function removeItems(PosterInterface $parent, PosterInterface $poster, $relationId = null)
    {
        $sql = \App::table('platform_relation_item')
            ->delete()
            ->where('poster_id=?', $poster->getId())
            ->where('parent_id=?', $parent->getId());

        if (null != $relationId) {
            $sql->where('relation_id=?', $relationId);
        }

        $sql->execute();
    }

    /**
     * @param PosterInterface $parent
     * @param PosterInterface $poster
     * @param        $relationType
     * @param null            $relationId
     *
     * @return bool
     */
    public function removeRelationItem(PosterInterface $parent, PosterInterface $poster, $relationType = null, $relationId = null)
    {
        // remove all relation if $realtionType is RELATION_TYPE_MEMBER
        switch (true) {
            case $relationType == RELATION_TYPE_ANYONE:
            case $relationType == RELATION_TYPE_OWNER:
            case $relationType == RELATION_TYPE_REGISTERED:
                throw new \InvalidArgumentException("Could not remove relation item");
                break;
            case $relationType == null;
            case $relationType == RELATION_TYPE_MEMBER:
                $this->removeItems($parent, $poster);
                break;
            case $relationId != null:
                $this->removeItems($parent, $poster, $relationId);
                break;
            default:
                $relation = $this->findList($parent, $relationType, false);
                if (!$relation) {
                    throw new \InvalidArgumentException("Could not found associate relation");
                }
                $this->removeItems($parent, $poster, $relation->getId());
        }

        return true;
    }

    /**
     * Add poster to member list of parent
     *
     * @param PosterInterface $parent
     * @param PosterInterface $poster
     *
     * @return Platform\RelationItem
     */
    public function buildRelationItemMember(PosterInterface $parent, PosterInterface $poster)
    {
        $relation = $this->findList($parent, RELATION_TYPE_MEMBER, true);

        if (!$relation) {
            throw new \InvalidArgumentException("Could not add relation");
        }

        $item = \App::table('platform_relation_item')
            ->select()
            ->where('relation_id=?', $relation->getId())
            ->where('poster_id=?', $poster->getId())
            ->where('parent_id=?', $parent->getId())
            ->one();

        if (!$item) {
            $item = new RelationItem([
                'poster_id'   => $poster->getId(),
                'parent_id'   => $parent->getId(),
                'poster_type' => $poster->getType(),
                'relation_id' => $relation->getId(),
            ]);
            $item->save();
        }

        return $item;
    }


    /**
     * @param PosterInterface $parent
     * @param PosterInterface $poster
     * @param int             $relationType
     * @param null            $relationId
     *
     * @return Platform\RelationItem
     */
    public function addRelationItem(PosterInterface $parent, PosterInterface $poster, $relationType, $relationId = null)
    {

        switch (true) {
            case $relationType >= RELATION_TYPE_CUSTOM:
            case $relationType == RELATION_TYPE_ANYONE:
            case $relationType == RELATION_TYPE_REGISTERED:
            case $relationType == RELATION_TYPE_OWNER:
            case $relationType == RELATION_TYPE_CUSTOM && null == $relationId:
                throw new \InvalidArgumentException("Invalid relation type");
        }

        if (null == $relationId) {
            $relation = $this->findList($parent, $relationType, true);
        } else {
            $relation = \App::table('platform_relation')
                ->findById($relationId);
        }

        if (null == $relation) {
            throw new \InvalidArgumentException("Invalid relation type");
        }

        // force relation type is not member
        $relationItem = \App::table('platform_relation_item')
            ->select()
            ->where('relation_id=?', $relation->getId())
            ->where('poster_id=?', $poster->getId())
            ->where('parent_id=?', $parent->getId())
            ->one();


        if (null == $relationItem) {
            $relationItem = new RelationItem(
                [
                    'relation_id' => $relation->getId(),
                    'parent_id'   => $parent->getId(),
                    'poster_id'   => $poster->getId(),
                    'poster_type' => $poster->getType(),
                ]
            );
            $relationItem->save();
        }

        // force add to member relation list.
        if ($relation->getRelationType() != RELATION_TYPE_MEMBER) {
            $this->buildRelationItemMember($poster, $parent);
        }

        return $relationItem;
    }

    /**
     * @param PosterInterface $parent
     * @param PosterInterface $poster
     */
    public function clearRelationItem(PosterInterface $parent, PosterInterface $poster)
    {
        \App::table('platform_relation_item')
            ->delete()
            ->where('poster_id=?', $poster->getId())
            ->where('parent_id=?', $parent->getId())
            ->execute();
    }

    /**
     * @param $parentType
     *
     * @return array [RelationType, ... ]
     */
    public function getRelationTypeForBuild($parentType)
    {
        return \App::table('platform_relation_type')
            ->select()
            ->where('parent_type =?', $parentType)
            ->where('is_build=?', 1)
            ->order('relation_type', -1)
            ->all();
    }

    /**
     * Load data from `kendo_core_relation_type`
     * conditions (is_build=1, parent_type = $poster.type, relation_type < RELATION_TYPE_CUSTOM)
     * Add data to `kendo_core_relation`
     *
     * Do not add RELATION_TYPE_OWNER, RELATION_TYPE_PUBLIC, ...
     *
     * @param PosterInterface $parent
     */
    public function buildRelationsForPoster(PosterInterface $parent)
    {
        $relationTypes = $this->getRelationTypeForBuild($parent->getType());

        foreach ($relationTypes as $relationType) {
            $this->addList($parent, $relationType->getRelationType(), $relationType->getRelationName(), 0);
        }
    }

    /**
     * @param PosterInterface $parent
     * @param PosterInterface $poster
     *
     * @return bool
     */
    private function hasMemberRelation(PosterInterface $parent, PosterInterface $poster)
    {
        return null != \App::table('platform_relation_item')
            ->select()
            ->where('parent_id=?', $parent->getId())
            ->where('poster_id=?', $poster->getId())
            ->one();

    }

    /**
     * @param PosterInterface $parent
     * @param PosterInterface $poster
     * @param int             $relationId
     *
     * @return bool
     */
    private function hasSpecificRelation(PosterInterface $parent, PosterInterface $poster, $relationId)
    {
        return null != \App::table('platform_relation_item')
            ->select()
            ->where('relation_id=?', (string)$relationId)
            ->where('parent_id=?', $parent->getId())
            ->where('poster_id=?', $poster->getId())
            ->one();
    }

    /**
     * Check there are relation between $parent and $poster
     *
     * @param PosterInterface $parent
     * @param PosterInterface $poster
     * @param int             $relationType
     * @param int             $relationId
     *
     * @return bool
     */
    public function hasRelationItem(PosterInterface $parent, PosterInterface $poster, $relationType = null, $relationId = null)
    {
        switch (true) {
            case $relationType == RELATION_TYPE_ANYONE:
            case $relationType == RELATION_TYPE_REGISTERED:
                return true;

            case $relationType == null && $relationId == null;
            case $relationType == RELATION_TYPE_MEMBER:
                return $this->hasMemberRelation($parent, $poster);

            case $relationId != null:
                return $this->hasSpecificRelation($parent, $poster, $relationId);

            case $relationType != null:
                $relation = $this->findList($parent, $relationType, false);
                if (!$relation) {
                    return false;
                }

                return $this->hasSpecificRelation($parent, $poster, $relation->getId());
        }

        return false;
    }

    /**
     * @param int $parentId
     * @param int $objectId
     *
     * @return bool
     */
    public function isMemberOfMember($parentId, $objectId)
    {

        return $this->getMutualMemberSelect($parentId, $objectId)->count() > 0;

    }


    /**
     * @param int $parentId
     * @param int $objectId
     *
     * @return int
     */
    public function getMutualMemberCount($parentId, $objectId)
    {
        return $this->getMutualMemberSelect($parentId, $objectId)->count();
    }

    /**
     * @param int $parentId
     * @param int $objectId
     *
     * @return \Kendo\Db\SqlSelect
     */
    public function getMutualMemberSelect($parentId, $objectId)
    {
        $subquery = \App::table('platform_relation_item')
            ->select()
            ->where('parent_id=?', $objectId)
            ->columns('poster_id');

        return \App::table('platform_relation_item')
            ->select()
            ->where('parent_id=?', $parentId)
            ->where('poster_id IN (?)', $subquery);

    }


    /**
     * @param int $parentId
     *
     * @return array
     */
    public function getPrivacyListByParentId($parentId)
    {

        return \App::table('platform_relation')
            ->select()
            ->where('parent_id=?', $parentId)
            ->all();
    }

    /**
     * @param int $parentId
     *
     * @return array
     */
    public function getPrivacyIdListByParentId($parentId)
    {
        return \App::table('platform_relation')
            ->select()
            ->where('parent_id=?', $parentId)
            ->toInts('relation_id');
    }

    /**
     * Get all reation types by parent_type in `kendo_core_relation_type`
     * condition (parent_type=?)
     *
     * @param string $parentType
     *
     * @return array
     */
    public function getAllRelationTypes($parentType)
    {

        return \App::table('platform_relation_type')
            ->select()
            ->where('parent_type=?', $parentType)
            ->order('relation_type', -1)
            ->all();
    }

    /**
     * Get all reation types by parent_type in `kendo_core_relation_type`
     * condition (parent_type=?) where relation_type < RELATION_TYPE_CUSTIOM constant
     *
     * @param string $parentType
     *
     * @return array
     */
    public function getAllSystemRelationType($parentType)
    {
        return \App::table('platform_relation_type')
            ->select()
            ->where('parent_type=?', $parentType)
            ->where('relation_type<?', RELATION_TYPE_CUSTOM)
            ->order('relation_type', -1)
            ->all();
    }

    /**
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     * @param array           $accepts
     * @param array           $excludes
     *
     * @return array
     */
    public function getPrivacyOptions(PosterInterface $poster, PosterInterface $parent, $accepts = [], $excludes = [])
    {
        $typeIdList = \App::aclService()->allow(sprintf('%s__privacy_option', $parent->getType()), [1, 2, 0]);

        if (empty($typeIdList)) {
            return [];
        }

        $list = $this->getPrivacyListByParentId($parent->getId());

        $response = [];

        $parentType = $parent->getType();


        $valueByTypes = [];

        $remarks = [];

        foreach ($list as $item) {
            if (!in_array($item->getRelationType(), $typeIdList)) {
                continue;
            }

            $valueByTypes[ $item->getRelationType() ] = $item->getId();

        }

        foreach ($typeIdList as $typeId) {

            // don't make it work here
            if ($typeId >= RELATION_TYPE_CUSTOM) continue;

            $remarks[ $typeId ] = 1;

            $value = null;

            if ($typeId == RELATION_TYPE_OWNER) {
                $value = 0;
            } else if (!empty($valueByTypes[ $typeId ])) {
                $value = $valueByTypes[ $typeId ];
            } else if ($typeId == RELATION_TYPE_MEMBER) {
                $value = $parent->getId();
            } else if ($typeId == RELATION_TYPE_MEMBER_OF_MEMBER) {
                $value = $parent->getId();
            } else {
                $value = $typeId;
            }

            $response[] = [
                'type'  => $typeId,
                'label' => \App::text('relation.relation_type_' . $parentType . '_' . $typeId),
                'value' => $value,
            ];
        }


        foreach ($list as $item) {

            if (!in_array($item->getRelationType(), $typeIdList)) continue;

            if (!empty($remarks[ $item->getRelationType() ])) continue;

            $response[] = [
                'type'  => $item->getRelationType(),
                'value' => $item->getRelationId(),
                'label' => strtr($item->getRelationName(), ['$parent' => $parent->getTitle()]),
            ];
        }

        $acceptMap = [];
        $excludeMap = [];
        $onlyAccept = !empty($accepts);

        if (!empty($accepts)) {
            foreach ($accepts as $accept) {
                $acceptMap[ $accept ] = 1;
            }
        }

        if (!empty($excludes)) {
            foreach ($excludes as $exclude) {
                $excludeMap[ $exclude ] = 1;
            }
        }

        foreach ($response as $offset => $value) {
            if ($onlyAccept) {
                if (empty($acceptMap[ $value['type'] ])) {
                    unset($response[ $offset ]);
                }
            }

            if (!empty($excludeMap[ $value['type'] ])) {
                unset($response[ $offset ]);
            }
        }

        return array_values($response);

    }

    /**
     * @param $relationId
     *
     * @return Platform\Relation
     */
    public function findById($relationId)
    {
        return \App::table('platform_relation')
            ->findById((string)$relationId);
    }

    /**
     * @param PosterInterface $parent
     * @param PosterInterface $poster
     * @param        $forAction
     * @param int             $relationType
     * @param int             $relationId
     *
     * @return string
     */
    public function getRelationOptionForSelect(PosterInterface $parent, PosterInterface $poster, $forAction, $relationType = null, $relationId = null)
    {
        if ($poster->getUserId() != $parent->getUserId()) {
            return false;
        }


        if (null === $relationId || null === $relationType) {
            list($relationType, $relationId) = $parent->getPrivacy($forAction);
        }

        if (null == $relationId) {
            $relationType = RELATION_TYPE_ANYONE;
            $relationId = RELATION_TYPE_ANYONE;
        }

        $parentType = $parent->getType();
        $msgId = null;

        if ($relationType < RELATION_TYPE_CUSTOM) {
            return [
                'type'  => $relationType,
                'value' => $relationId,
                'label' => \App::text('relation.relation_type_' . $parentType . '_' . $relationType),
            ];
        }

        $item = \App::relationService()->findById($relationId);

        if (!$item instanceof Relation)
            return [
                'type'  => RELATION_TYPE_ANYONE,
                'value' => RELATION_TYPE_ANYONE,
                'label' => 'relation.relation_type_public',
            ];

        return [
            'type'  => $item->getRelationType(),
            'value' => $item->getRelationId(),
            'label' => strtr($item->getRelationName(), ['$parent' => $parent->getTitle()]),
        ];
    }

    /**
     * @return array
     */
    public function getDefaultRelationPriorityList()
    {
        return [RELATION_TYPE_ADMIN, RELATION_TYPE_EDITOR, RELATION_TYPE_OFFICER, RELATION_TYPE_MEMBER, RELATION_TYPE_MEMBER_OF_MEMBER];
    }

    /**
     * @param string $posterId
     * @param array  $parentIdList
     *
     * @return array
     */
    public function getListRelationTypeForPoster($posterId, $parentIdList)
    {
        /**
         * Check in member list in groups.
         * In member list
         */
        $map1 = \App::table('platform_relation_item')
            ->select()
            ->where('poster_id =?', $posterId)
            ->where('parent_id IN ?', $parentIdList)
            ->columns('relation_id, parent_id')
            ->toAssocs();


        if (empty($map1)) {
            return [];
        }

        $relationIdList = [];

        foreach ($map1 as $row) {
            $relationIdList[] = $row['relation_id'];
        }

        if (empty($relationIdList)) {
            return [];
        }


        /**
         * fetch relation type in relation list
         */
        $map2 = \App::table('platform_relation')
            ->select()
            ->where('relation_id IN ?', $relationIdList)
            ->columns('relation_type, parent_id')
            ->toAssocs();


        $typeList = [];

        foreach ($map2 as $row) {
            $typeList[ $row['relation_type'] ][] = $row['parent_id'];
        }

        $response = [];

        foreach ($typeList as $type => $ids) {
            foreach ($ids as $id) {
                $response[ $id ][] = $type;
            }

        }

        return $response;
    }

    /**
     * @param string $posterId
     * @param array  $parentIdList
     *
     * @return array
     */
    public function getListRelationIdForPoster($posterId, $parentIdList)
    {
        /**
         * Check in member list in groups.
         * In member list
         */
        $map1 = \App::table('platform_relation_item')
            ->select()
            ->where('poster_id =?', $posterId)
            ->where('parent_id IN ?', $parentIdList)
            ->columns('relation_id, parent_id')
            ->toAssocs();

        if (empty($map1)) {
            return [];
        }

        $response = [];

        foreach ($map1 as $row) {
            $response[ $row['parent_id'] ][] = $row['relation_id'];
        }

        return $response;
    }

    /**
     * @param $parentId
     * @param $posterId
     *
     * @return array [id=>$type]
     */
    public function getListRelationIdBetween($parentId, $posterId)
    {
        return \App::table('platform_relation_item')
            ->select()
            ->where('poster_id = ?', $posterId)
            ->where('parent_id = ?', $parentId)
            ->columns('relation_id, parent_id')
            ->toPairs('relation_id', 'parent_id');
    }


    /**
     * @param array  $posterIdList
     * @param string $parentId
     *
     * @return array
     */
    public function getListRelationTypeForParent($posterIdList, $parentId)
    {
        /**
         * Check in member list in groups.
         * In member list
         */
        $rows = \App::table('platform_relation_item')
            ->select()
            ->where('poster_id IN ?', $posterIdList)
            ->where('parent_id = ?', $parentId)
            ->columns('relation_id, poster_id')
            ->toAssocs();

        if (empty($rows)) {
            return [];
        }

        $relationIdList = [];
        $posterIdMap = [];

        foreach ($rows as $row) {
            $relationIdList[] = $row['relation_id'];
        }

        if (empty($relationIdList)) {
            return [];
        }

        /**
         * fetch relation type in relation list
         */

        $pairs = \App::table('platform_relation')
            ->select()
            ->where('relation_id IN ?', $relationIdList)
            ->toPairs('relation_id', 'relation_type');

        foreach ($rows as $row) {
            if (empty($pairs[ $row['relation_id'] ])) {
                $pairs[ $row['relation_id'] ] = RELATION_TYPE_MEMBER;
            }
            $posterIdMap[ $pairs[ $row['relation_id'] ] ][] = $row['poster_id'];
        }

        $response = [];

        foreach ($posterIdMap as $type => $ids) {
            foreach ($ids as $id) {
                $response[ $id ][] = $type;
            }
        }

        return $response;
    }

    /**
     * @param array  $posterIdList
     * @param string $parentId
     *
     * @return array
     */
    public function getListRelationIdForParent($posterIdList, $parentId)
    {
        /**
         * Check in member list in groups.
         * In member list
         */
        $rows = \App::table('platform_relation_item')
            ->select()
            ->where('poster_id IN ?', $posterIdList)
            ->where('parent_id = ?', $parentId)
            ->columns('relation_id, poster_id')
            ->toAssocs();

        if (empty($rows)) {
            return [];
        }

        $response = [];

        foreach ($rows as $row) {
            $response[ $row['poster_id'] ][] = $row['relation_id'];
        }

        return $response;
    }

    /**
     * @param string $posterId
     * @param string $parentId
     *
     * @return int
     */
    public function getListRelationType($posterId, $parentId)
    {
        /**
         * Check in member list in groups.
         * In member list
         */
        $relationIdList = \App::table('platform_relation_item')
            ->select()
            ->where('poster_id=?', $posterId)
            ->where('parent_id =  ?', $parentId)
            ->fields('relation_id');

        if (empty($relationIdList)) {
            return 0;
        }

        /**
         * fetch relation type in relation list
         */

        return \App::table('platform_relation')
            ->select()
            ->where('relation_id=?', $relationIdList)
            ->fields('relation_type');

    }

    /**
     * @param ContentInterface $about
     * @param PosterInterface  $viewer
     *
     * @return string
     */
    public function getPrivacyLabel(ContentInterface $about, PosterInterface $viewer = null)
    {
        $isOwner = false;

        /**
         * Is poster of content
         */
        if ($about->viewerIsParent())
            $isOwner = true;

        $relationType = $about->getPrivacyType();
        $parentType = $about->getParentType();


        if ($relationType < RELATION_TYPE_CUSTOM) {
            switch ($relationType) {
                case RELATION_TYPE_ANYONE:
                    $msgId = 'relation.privacy_label_public';
                    break;
                case RELATION_TYPE_OWNER:
                    $msgId = 'relation.' . $parentType . '_privacy_label_owner';
                    break;
                case RELATION_TYPE_MEMBER_OF_MEMBER:
                    $msgId = 'relation.' . $parentType . '_privacy_label_member_of_members';
                    break;
                case RELATION_TYPE_ADMIN:
                    $msgId = 'relation.' . $parentType . '_privacy_label_admin';
                    break;
                case RELATION_TYPE_EDITOR:
                    $msgId = 'relation.' . $parentType . '_privacy_label_editor';
                    break;
                case RELATION_TYPE_MEMBER:
                    $msgId = 'relation.' . $parentType . '_privacy_label_member';
                    break;
                case RELATION_TYPE_REGISTERED:
                    $msgId = 'relation.' . $parentType . '_privacy_label_registered';
                    break;
                default:
                    $msgId = 'relation.' . $parentType . '_privacy_label_custom';

            }
        }

        if (empty($msgId)) {

            $relationId = $about->getPrivacyValue();

            $item = $this->findById($relationId);

            if ($item) {
                $msgId = $item->getRelationTitle();
            }
        }

        if (empty($msgId)) {
            $msgId = 'relation.' . $about->getParentType() . '_privacy_label_custom';
        }

        /**
         *
         */
        $parent = $about->getParent();

        if ($isOwner) {
            return \App::text($msgId, ['$parent\'s' => 'Your', '$parent' => 'You']);
        }

        $label = $parent->getTitle();

        return \App::text($msgId, ['$parent' => $label]);
    }

    /**
     * @param string $posterId
     * @param string $parentId
     *
     * @return int
     */
    public function getListRelationId($posterId, $parentId)
    {
        /**
         * Check in member list in groups.
         * In member list
         */
        return \App::table('platform_relation_item')
            ->select()
            ->where('poster_id=?', $posterId)
            ->where('parent_id =  ?', $parentId)
            ->fields('relation_id');
    }

    /**
     * @param PosterInterface $parent
     * @param int             $relationType
     *
     * @return string
     */
    public function getRelationIdForParent(PosterInterface $parent, $relationType = RELATION_TYPE_MEMBER)
    {
        return \App::table('platform_relation')
            ->select()
            ->where('parent_id =  ?', $parent->getId())
            ->where('relation_type=?', $relationType)
            ->limit(1, 0)
            ->field('relation_id');
    }

    /**
     * Get Platform\Relation Setting from privacy
     *
     * @param array $data
     * @param array $list
     *
     * @return array
     */
    public function getRelationFromData($data, $list)
    {
        $response = [];

        foreach ($list as $name) {

            if (empty($data[ $name ])) continue;

            list($group, $key) = explode('__', $name);

            $privacy = $data[ $name ];
            $temp = $key == 'view' ? 'view' : $group . '__' . $key;
            $response[ $temp ] = [
                'type'  => $privacy['type'],
                'value' => $privacy['value']
            ];
        }

        return $response;
    }

    /**
     * Get Platform\Relation data for save
     *
     * @param array $data
     * @param array $list
     *
     * @return array
     */
    public function getRelationFromDataForSave($data, $list)
    {
        $privacy = $this->getRelationFromData($data, $list);

        $view = [
            'type'  => RELATION_TYPE_ANYONE,
            'value' => RELATION_TYPE_ANYONE
        ];

        if (!empty($privacy['view']))
            $view = $privacy['view'];

        return [
            'privacy_type'  => $view['type'],
            'privacy_value' => $view['value'],
            'privacy_text'  => json_encode($privacy)
        ];
    }

    /**
     * Relation all by poster
     *
     * @param PosterInterface $poster
     */
    public function relationByPoster($poster)
    {
        \App::table('platform_relation_item')
            ->delete()
            ->where('parent_id=?', $poster->getId())
            ->orWhere('poster_id=?', $poster->getId())
            ->execute();

        \App::table('platform_relation')
            ->delete()
            ->where('parent_id=?', $poster->getId())
            ->execute();
    }

    /**
     * @param     $query
     * @param     $page
     * @param int $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadMemberPaging($query, $page, $limit = 10)
    {
        $profile = null;

        if (!empty($query['parentId']) && !empty($query['parentType'])) {
            $profile = \App::find($query['parentType'], $query['parentId']);
        }

        if (!$profile instanceof PosterInterface) {
            throw new \InvalidArgumentException();
        }

        return $this->getSelectMembershipForParent($profile)->paging($page, $limit);
    }

    /**
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     *
     * @return Platform\RelationRequest
     */
    public function findMembershipRequest(PosterInterface $poster, PosterInterface $parent)
    {
        return \App::table('platform_relation_request')
            ->select()
            ->where('poster_id=?', $poster->getId())
            ->where('parent_id=?', $parent->getId())
            ->one();
    }

    /**
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     * @param string          $status
     *
     * @return Platform\RelationRequest
     */
    private function addMembershipRequest(PosterInterface $poster, PosterInterface $parent, $status = 'sent')
    {
        $request = new RelationRequest([
            'parent_id'     => $parent->getId(),
            'poster_id'     => $poster->getId(),
            'poster_type'   => $poster->getType(),
            'parent_type'   => $parent->getType(),
            'relation_type' => RELATION_TYPE_MEMBER,
            'status'        => $status,
            'created_at'    => KENDO_DATE_TIME,
        ]);

        $request->save();

        return $request;
    }

    /**
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     *
     * @return bool
     */
    public function sendMembershipRequest(PosterInterface $poster, PosterInterface $parent)
    {
        $request = $this->findMembershipRequest($poster, $parent);

        if (null != $request) {
            $request->setStatus('sent');
            // re-update request
            $request->setCreatedAt(KENDO_DATE_TIME);
            $request->save();

            /**
             * trigger resend membership request
             */
            \App::hookService()
                ->notify('onResendRelationRequest', [
                    'poster'  => $poster,
                    'parent'  => $parent,
                    'request' => $request]);

        } else {
            /**
             * Other case see onAfterInsertRelationRequest instead
             */
            $this->addMembershipRequest($poster, $parent);
        }

        return true;
    }

    /**
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     *
     * @return bool
     */
    public function cancelMembershipRequest(PosterInterface $poster, PosterInterface $parent)
    {
        $request = $this->findMembershipRequest($poster, $parent);

        if ($request) {
            $request->setStatus('canceled');
            $request->save();

            \App::hookService()
                ->notify('onCancelRelationRequest', ['poster' => $poster, 'parent' => $parent, 'request' => $request]);
        }

        return true;
    }

    /**
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     * @param bool            $checkRequest = true
     *
     * @return bool
     */
    public function acceptMembershipRequest(PosterInterface $poster, PosterInterface $parent, $checkRequest = true)
    {
        // make group is member of group type

        $request = $this->findMembershipRequest($poster, $parent);

        if ($checkRequest && !$request) {
            throw new \InvalidArgumentException("There are no request");
        }

        if ($request) {
            $request->delete();
        }

        \App::hookService()
            ->notify('onAcceptRelationRequest', ['poster' => $poster, 'parent' => $parent, 'request' => $request]);
    }

    /**
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     *
     * @return bool
     */
    public function ignoreMembershipRequest(PosterInterface $poster, PosterInterface $parent)
    {
        $request = $this->findMembershipRequest($poster, $parent);

        if ($request) {
            $request->setStatus('ignored');
            $request->save();

            \App::hookService()
                ->notify('onIgnoreRelationRequest', ['poster' => $poster, 'parent' => $parent, 'request' => $request]);
        }

        return true;
    }

    /**
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     *
     * @return bool
     */
    public function inviteRequest(PosterInterface $poster, PosterInterface $parent)
    {

    }


    /**
     * @param PosterInterface $poster
     * @param mixed           $parents
     *
     * @return array
     */
    public function getListMembershipStatusForPoster(PosterInterface $poster, $parents)
    {
        if (null == $poster || null == $parents) {
            return [];
        }

        $response = [];

        $parentIdList = [];

        $posterId = $poster->getId();

        foreach ($parents as $parent) {

            if (!$parent instanceof PosterInterface) continue;

            $id = $parent->getId();

            if ($parent->getUserId() == $posterId) {
                $response[ $id ] = RELATION_TYPE_OWNER;
            } else {
                $parentIdList[] = $id;
                $response[ $id ] = self::IS_EMPTY;
            }
        }

        if (empty($parentIdList)) {
            return $response;
        }

        $relationList = \App::relationService()->getListRelationTypeForPoster($posterId, $parentIdList);

        foreach ($relationList as $id => $type) {
            if ($response[ $id ] == 0) {
                $response[ $id ] = $type;
            }
        }

        $parentIdList = array_diff($parentIdList, array_keys($relationList));

        if (empty($parentIdList)) {
            return $response;
        }

        /**
         * Request Received?
         */
        $receivedIdList = \App::table('platform_relation_request')
            ->select()
            ->where('poster_id IN ?', $parentIdList)
            ->where('parent_id = ?', $posterId)
            ->where('status NOT IN ?', ['canceled', 'ignored', 'accepted'])
            ->fields('poster_id');


        /**
         * what is happend in this case
         */
        foreach ($receivedIdList as $id) {
            $response[ $id ] = self::REQUEST_RECEIVED;
        }

        $parentIdList = array_diff($parentIdList, $receivedIdList);

        if (empty($parentIdList)) {
            return $response;
        }


        /**
         * Request Sent?
         */
        $sendIdList = \App::table('platform_relation_request')
            ->select()
            ->where('poster_id=?', $posterId)
            ->where('parent_id IN ?', $parentIdList)
            ->where('status NOT IN ?', ['canceled', 'ignored', 'accepted'])
            ->fields('parent_id');


        /**
         * what is in this case
         */
        foreach ($sendIdList as $id) {
            $response[ $id ] = self::REQUEST_SENT;
        }

        return $response;
    }

    /**
     * @param array           $posters
     * @param PosterInterface $parent
     *
     * @return array
     */
    public function getListMembershipStatusForParent($posters, PosterInterface $parent)
    {
        if (null == $posters || null == $parent) {
            return [];
        }

        $response = [];
        $parentId = $parent->getId();

        $posterIdList = [];

        foreach ($posters as $poster) {

            if (!$poster instanceof PosterInterface) continue;

            $posterId = $poster->getId();

            if ($parent->getUserId() == $posterId) {
                $response[ $posterId ] = RELATION_TYPE_OWNER;
            } else {
                $posterIdList[] = $posterId;
                $response[ $posterId ] = self::IS_EMPTY;
            }
        }

        if (empty($posterIdList)) {
            return $response;
        }

        $relationList = \App::relationService()->getListRelationTypeForParent($posterIdList, $parentId);

        foreach ($relationList as $id => $type) {
            if ($response[ $id ] == 0) {
                $response[ $id ] = $type;
            }
        }

        $posterIdList = array_diff($posterIdList, array_keys($relationList));

        if (empty($posterIdList)) {
            return $response;
        }

        /**
         * Request received
         */
        $receivedIdList = \App::table('platform_relation_request')
            ->select()
            ->where('poster_id IN ?', $posterIdList)
            ->where('parent_id = ?', $parentId)
            ->where('status NOT IN ?', ['canceled', 'ignored', 'accepted'])
            ->fields('poster_id');

        /**
         * what is  in this case
         */
        foreach ($receivedIdList as $id) {
            $response[ $id ] = self::REQUEST_RECEIVED;
        }

        $posterIdList = array_diff($posterIdList, $receivedIdList);

        if (empty($posterIdList)) {
            return $response;
        }

        /**
         * Request sent?
         */
        $sentIdList = \App::table('platform_relation_request')
            ->select()
            ->where('poster_id = ?', $parentId)
            ->where('parent_id IN ?', $posterIdList)
            ->where('status NOT IN ?', ['canceled', 'ignored', 'accepted'])
            ->fields('parent_id');

        /**
         * what is  in this case
         */
        foreach ($sentIdList as $id) {
            $response[ $id ] = self::REQUEST_SENT;
        }

        // check what is  in this case
        return $response;
    }

    /**
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     *
     * @return int
     */
    public function getMembershipStatus(PosterInterface $poster, PosterInterface $parent)
    {
        if (null == $poster || null == $parent) {
            return [];
        }

        $posterId = $poster->getId();
        $parentId = $parent->getId();

        if ($parent->getUserId() == $posterId) {
            return RELATION_TYPE_OWNER;
        }

        $highestRelation = \App::relationService()->getListRelationType($posterId, $parentId);

        if ($highestRelation) {
            return $highestRelation;
        }

        /**
         * Received request?
         */
        $status = \App::table('platform_relation_request')
            ->select()
            ->where('poster_id=?', $parentId)
            ->where('parent_id = ?', $posterId)
            ->where('status NOT IN ?', ['canceled', 'ignored', 'accepted'])
            ->field('status');

        if ($status) {
            return self::REQUEST_RECEIVED;
        }

        /**
         * Sent request?
         */
        $status = \App::table('platform_relation_request')
            ->select()
            ->where('poster_id=?', $posterId)
            ->where('parent_id = ?', $parentId)
            ->where('status NOT IN ?', ['canceled', 'ignored', 'accepted'])
            ->field('status');

        if ($status) {
            return self::REQUEST_SENT;
        }

        // check what is happended in this case
        return self::IS_EMPTY;
    }

    /**
     * Remove membership directly, does not require membership request
     *
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     *
     * @return bool
     */
    public function removeMembership(PosterInterface $poster, PosterInterface $parent)
    {
        \App::hookService()
            ->notify('onClearMembership', ['poster' => $poster, 'parent' => $parent]);
    }

    /**
     * @param PosterInterface $parent
     *
     * @return \Kendo\Db\SqlSelect`
     */
    public function getSelectRelationRequestForParent(PosterInterface $parent)
    {
        return \App::table('platform_relation_request')
            ->select()
            ->where('parent_id=?', $parent->getId())
            ->where('status NOT IN ?', ['canceled', 'ignored', 'accepted']);
    }

    /**
     * @param PosterInterface $parent
     *
     * @return \Kendo\Db\SqlSelect
     */
    public function getSelectMembershipForParent(PosterInterface $parent)
    {

        $relationId = $parent->getId();

        return \App::table('platform_relation_item')
            ->select()
            ->where('relation_id=?', $relationId);
    }

    /**
     * @param array $moduleList
     * @return array
     */
    public function getListRelationTypeByModuleName($moduleList)
    {
        return \App::table('platform_relation_type')
            ->select()
            ->where('module_name IN ?', $moduleList)
            ->toAssocs();
    }
}