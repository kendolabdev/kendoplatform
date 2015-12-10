<?php

namespace Base\Page\Service;

use Base\Page\Model\Page;
use Base\Page\Model\PageCategory;
use Kendo\Content\PosterInterface;

/**
 * Class PageService
 *
 * @package Page\Service
 */
class PageService
{

    /**
     * @param string $id
     *
     * @return \Base\Page\Model\PageCategory
     */
    public function findCategoryById($id)
    {
        return \App::table('page.page_category')
            ->findById(intval($id));
    }

    /**
     * @param array $data
     *
     * @return \Base\Page\Model\PageCategory
     */
    public function addCategory($data = [])
    {

        if (empty($data['category_name']))
            throw new \InvalidArgumentException("Missing params [category_name]");

        $entry = new PageCategory($data);

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
        $select = \App::table('page.page_category')->select('t');

        if (!empty($query['q']))
            $select->where('category_name like ?', '%' . $query['q'] . '%');

        return $select->paging($page, $limit);
    }

    /**
     * @param     $context
     * @param     $page
     * @param int $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadPagePaging($context, $page, $limit = 12)
    {

        $select = \App::table('page')->select();

        $isOwner = false;

        if (!empty($context['posterId'])) {

            $posterId = $context['posterId'];

            $select->where('poster_id=?', $posterId);

            if ($posterId == \App::authService()->getId()) {

                $isOwner = true;
            }
        }

        if (!empty($context['userId'])) {

            $userId = $context['userId'];

            $select->where('user_id=?', $userId);

            if ($userId == \App::authService()->getUserId()) {
                $isOwner = true;
            }
        }

        if (!empty($context['parentId'])) {

            $parentId = $context['parentId'];

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
     * Get approval & enabled members
     *
     * @return int
     */
    public function getActivePageCount()
    {
        return \App::table('page')
            ->select()
            ->where('is_approved=?', 1)
            ->where('is_published=?', 1)
            ->where('is_active=?', 1)
            ->count();
    }

    /**
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     * @param array           $params
     *
     * @return Page
     */
    public function addPage(PosterInterface $poster, PosterInterface $parent, $params = [])
    {
        $page = new Page([
            'user_id'        => $poster->getUserId(),
            'poster_id'      => $poster->getId(),
            'poster_type'    => $poster->getType(),
            'parent_id'      => $parent->getId(),
            'parent_type'    => $parent->getType(),
            'parent_user_id' => $parent->getUserId(),
            'created_at'     => KENDO_DATE_TIME,
            'modified_at'    => KENDO_DATE_TIME,
        ]);

        $page->setFromArray($params);

        $page->save();

        return $page;
    }

    /**
     * @return array
     */
    public function getCategoryOptions()
    {

        return \App::cacheService()
            ->get(['page', 'getCategoryOptions'], 0, function () {
                return $this->_getCategoryOptions();
            });

    }


    /**
     * @return array
     */
    private function _getCategoryOptions()
    {
        $select = \App::table('page.category')->select()
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