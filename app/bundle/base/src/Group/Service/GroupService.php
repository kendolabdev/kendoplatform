<?php

namespace Group\Service;

use Group\Model\Group;
use Group\Model\GroupCategory;
use Picaso\Content\Poster;

/**
 * Class GroupService
 *
 * @package Group\Service
 */
class GroupService
{
    /**
     * @param string $id
     *
     * @return \Group\Model\GroupCategory
     */
    public function findCategoryById($id)
    {
        return \App::table('group.group_category')
            ->findById(intval($id));
    }

    /**
     * @param array $data
     *
     * @return \Group\Model\GroupCategory
     */
    public function addCategory($data = [])
    {

        if (empty($data['category_name']))
            throw new \InvalidArgumentException("Missing params [category_name]");

        $entry = new GroupCategory($data);

        $entry->save();

        return $entry;

    }

    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Picaso\Paging\PagingInterface
     */
    public function loadAdminCategoryPaging($query = [], $page = 1, $limit = 12)
    {
        $select = \App::table('group.group_category')->select('t');

        if (!empty($query['q']))
            $select->where('category_name like ?', '%' . $query['q'] . '%');

        return $select->paging($page, $limit);
    }

    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Picaso\Paging\PagingInterface
     */
    public function loadGroupPaging($query, $page = 1, $limit = 2)
    {
        $select = \App::table('group')
            ->select();

        $isOwner = false;

        if (!empty($query['posterId'])) {

            $posterId = $query['posterId'];

            $select->where('poster_id=?', $posterId);

            if ($posterId == \App::auth()->getId()) {

                $isOwner = true;
            }
        }

        if (!empty($query['userId'])) {

            $userId = $query['userId'];

            $select->where('user_id=?', $userId);

            if ($userId == \App::auth()->getUserId()) {
                $isOwner = true;
            }
        }

        if (!empty($query['parentId'])) {

            $parentId = $query['parentId'];

            $select->where('parent_id=?', $parentId);
        }

        if (!$isOwner) {
            /**
             * check privacy
             */
            $select->where('privacy_type IN ?', [0, 1, 2]);
        }

        $select->order('created_at', -1);

        return $select->paging($page, $limit);

    }

    /**
     * @return int
     */
    public function getAdminStatisticCount()
    {
        return \App::table('group')
            ->select()
            ->count();
    }

    /**
     * @param Poster $poster
     * @param Poster $parent
     * @param array  $params
     *
     * @return Group
     */
    public function addGroup(Poster $poster, Poster $parent, $params = [])
    {
        $group = new Group([
            'user_id'        => $poster->getUserId(),
            'poster_id'      => $poster->getId(),
            'poster_type'    => $poster->getType(),
            'parent_id'      => $parent->getId(),
            'parent_type'    => $parent->getType(),
            'parent_user_id' => $parent->getUserId(),
            'created_at'     => PICASO_DATE_TIME,
            'modified_at'    => PICASO_DATE_TIME,
        ]);

        $group->setFromArray($params);

        $group->save();

        return $group;
    }

    /**
     * @return \Relation\Service\RelationService
     */
    public function membership()
    {
        return \App::relation();
    }

    /**
     * @return array
     */
    public function getCategoryOptions()
    {

        return \App::cache()
            ->get(['group', 'getCategoryOptions'], 0, function () {
                return $this->_getCategoryOptions();
            });

    }


    /**
     * @return array
     */
    private function _getCategoryOptions()
    {
        $select = \App::table('group.category')->select()
            ->order('category_name', 1);

        $items = $select->all();

        $options = [];

        foreach ($items as $item) {
            if (!$item instanceof Category) continue;
            $options[] = ['value' => $item->getId(), 'label' => $item->getTitle()];
        }

        return $options;
    }
}