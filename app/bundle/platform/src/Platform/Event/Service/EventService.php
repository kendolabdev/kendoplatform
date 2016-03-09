<?php

namespace Platform\Event\Service;

use Kendo\Kernel\KernelService;
use Platform\Event\Model\Event;
use Platform\Event\Model\EventCategory;
use Kendo\Content\PosterInterface;

/**
 * Class EventService
 *
 * @package Event\Service
 */
class EventService extends KernelService
{


    /**
     * @param string $id
     *
     * @return \Platform\Event\Model\EventCategory
     */
    public function findCategoryById($id)
    {
        return app()->table('event.event_category')
            ->findById(intval($id));
    }

    /**
     * @param array $data
     *
     * @return \Platform\Event\Model\EventCategory
     */
    public function addCategory($data = [])
    {

        if (empty($data['category_name']))
            throw new \InvalidArgumentException("Missing params [category_name]");

        $entry = new EventCategory($data);

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
        $select = app()->table('event.event_category')->select('t');

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
    public function loadEventPaging($query = [], $page = 1, $limit = 2)
    {
        $select = app()->table('platform_event')->select();

        $isOwner = false;

        if (!empty($query['posterId'])) {

            $posterId = $query['posterId'];

            $select->where('poster_id=?', $posterId);

            if ($posterId == app()->auth()->getId()) {

                $isOwner = true;
            }
        }

        if (!empty($query['userId'])) {

            $userId = $query['userId'];

            $select->where('user_id=?', $userId);

            if ($userId == app()->auth()->getUserId()) {
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
    public function getEventCount()
    {
        return app()->table('platform_event')
            ->select()
            ->count();
    }

    /**
     * @return \Platform\Relation\Service\RelationService
     */
    public function membership()
    {
        return app()->relation();
    }

    /**
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     * @param array           $params
     *
     * @return Event
     */
    public function addEvent(PosterInterface $poster, PosterInterface $parent, $params = [])
    {
        $group = new Event([
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
     * @return array
     */
    public function getCategoryOptions()
    {

        return app()->cacheService()
            ->get(['event', 'getCategoryOptions'], 0, function () {
                return $this->_getCategoryOptions();
            });

    }


    /**
     * @return array
     */
    private function _getCategoryOptions()
    {
        $select = app()->table('event.event_category')->select()
            ->order('category_name', 1);

        $items = $select->all();

        $options = [];

        foreach ($items as $item) {
            if (!$item instanceof EventCategory) continue;
            $options[] = ['value' => $item->getId(), 'label' => $item->getTitle()];
        }

        return $options;
    }
}