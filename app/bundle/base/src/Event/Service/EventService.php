<?php

namespace Event\Service;

use Event\Model\Event;
use Event\Model\EventCategory;
use Picaso\Content\Poster;

/**
 * Class EventService
 *
 * @package Event\Service
 */
class EventService
{


    /**
     * @param string $id
     *
     * @return \Event\Model\EventCategory
     */
    public function findCategoryById($id)
    {
        return \App::table('event.event_category')
            ->findById(intval($id));
    }

    /**
     * @param array $data
     *
     * @return \Event\Model\EventCategory
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
     * @return \Picaso\Paging\PagingInterface
     */
    public function loadAdminCategoryPaging($query = [], $page = 1, $limit = 12)
    {
        $select = \App::table('event.event_category')->select('t');

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
    public function loadEventPaging($query = [], $page = 1, $limit = 2)
    {
        $select = \App::table('event')->select();

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
    public function getEventCount()
    {
        return \App::table('event')
            ->select()
            ->count();
    }

    /**
     * @return \Relation\Service\RelationService
     */
    public function membership()
    {
        return \App::relation();
    }

    /**
     * @param Poster $poster
     * @param Poster $parent
     * @param array  $params
     *
     * @return Event
     */
    public function addEvent(Poster $poster, Poster $parent, $params = [])
    {
        $group = new Event([
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
     * @return array
     */
    public function getCategoryOptions()
    {

        return \App::cache()
            ->get(['event', 'getCategoryOptions'], 0, function () {
                return $this->_getCategoryOptions();
            });

    }


    /**
     * @return array
     */
    private function _getCategoryOptions()
    {
        $select = \App::table('event.event_category')->select()
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