<?php

namespace Platform\Group\Service;

use Kendo\Kernel\KernelServiceAgreement;
use Platform\Group\Model\Group;
use Platform\Group\Model\GroupCategory;
use Kendo\Content\PosterInterface;

/**
 * Class GroupService
 *
 * @package Group\Service
 */
class GroupService extends KernelServiceAgreement
{
    /**
     * @param string $id
     *
     * @return \Platform\Group\Model\GroupCategory
     */
    public function findCategoryById($id)
    {
        return \App::table('group.group_category')
            ->findById(intval($id));
    }

    /**
     * @param array $data
     *
     * @return \Platform\Group\Model\GroupCategory
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
     * @return \Kendo\Paging\PagingInterface
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
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadGroupPaging($query, $page = 1, $limit = 2)
    {
        $select = \App::table('group')
            ->select();

        $isOwner = false;

        if (!empty($query['posterId'])) {

            $posterId = $query['posterId'];

            $select->where('poster_id=?', $posterId);

            if ($posterId == \App::authService()->getId()) {

                $isOwner = true;
            }
        }

        if (!empty($query['userId'])) {

            $userId = $query['userId'];

            $select->where('user_id=?', $userId);

            if ($userId == \App::authService()->getUserId()) {
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
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     * @param array           $params
     *
     * @return Group
     */
    public function addGroup(PosterInterface $poster, PosterInterface $parent, $params = [])
    {
        $group = new Group([
            'user_id'        => $poster->getUserId(),
            'poster_id'      => $poster->getId(),
            'poster_type'    => $poster->getType(),
            'parent_id'      => $parent->getId(),
            'parent_type'    => $parent->getType(),
            'parent_user_id' => $parent->getUserId(),
            'created_at'     => KENDO_DATE_TIME,
            'modified_at'    => KENDO_DATE_TIME,
        ]);

        $group->setFromArray($params);

        $group->save();

        return $group;
    }

    /**
     * @return \Platform\Relation\Service\RelationService
     */
    public function membership()
    {
        return \App::relationService();
    }

    /**
     * @return array
     */
    public function getCategoryOptions()
    {

        return \App::cacheService()
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