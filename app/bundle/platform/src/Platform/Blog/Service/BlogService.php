<?php

namespace Platform\Blog\Service;

use Kendo\Kernel\KernelService;
use Platform\Blog\Model\BlogCategory;
use Platform\Blog\Model\BlogPost;
use Kendo\Content\PosterInterface;

/**
 * Class Base\BlogService
 *
 * @package Base\Blog\Service
 */
class BlogService extends KernelService
{

    /**
     * @param string $id
     *
     * @return \Platform\Blog\Model\BlogCategory
     */
    public function findCategoryById($id)
    {
        return app()->table('platform_blog_category')
            ->findById(intval($id));
    }

    /**
     * @param array $data
     *
     * @return \Platform\Blog\Model\BlogCategory
     */
    public function addCategory($data = [])
    {

        if (empty($data['category_name']))
            throw new \InvalidArgumentException("Missing params [category_name]");

        $entry = new BlogCategory($data);

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
        $select = app()->table('platform_blog_category')->select('t');

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
    public function loadAdminPostPaging($query, $page = 1, $limit = 12)
    {

        $select = app()->table('platform_blog_post')->select('t');

        if (!empty($query['q']))
            $select->where('title like :q OR description like :q or content like :q', [
                ':q' => '%' . $query['q'] . '%'
            ]);

        if (isset($query['approve']) && !in_array($query['approve'], ['', 'all', '-a']))
            $select->where('is_approved=?', $query['approve'] ? 1 : 0);

        if (isset($query['active']) && !in_array($query['active'], ['', 'all', '-a']))
            $select->where('is_active=?', $query['active'] ? 1 : 0);

        return $select->paging($page, $limit);

    }

    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadPostPaging($query, $page = 1, $limit = 12)
    {

        $select = app()->table('platform_blog_post')->select('t');

        $isOwner = false;
        $inProfile = false;

        if (!empty($query['posterId'])) {
            $posterId = $query['posterId'];

            $select->where('t.poster_id=?', $posterId);

            if ($posterId == app()->auth()->getId()) {
                $isOwner = true;
            }
        }

        if (!empty($query['userId'])) {

            $userId = $query['userId'];

            $select->where('t.user_id=?', $userId);

            if ($userId == app()->auth()->getUserId()) {
                $isOwner = true;
            }
        }

        if (!empty($query['parentId'])) {

            $parentId = $query['parentId'];

            $select->where('t.parent_id=?', $parentId);

            $inProfile = true;
        }

        if (!$inProfile) {
            $browsingMode = app()->setting('blog', 'browsing_mode');
            switch ($browsingMode) {
                case 0:
                    break;
                case 1:
                    $select->where(app()->followService()->getFollowingConditionForQuery(app()->auth()->getId(), 't'), null);
                    break;
            }
        }

        if (!$isOwner) {
            switch (app()->setting('blog', 'browsing_filter')) {
                case 0:
                    $select->where(app()->relation()->getPrivacyConditionForQuery(app()->auth()->getId(), 't'), null);
                    break;
                case 1:
                    if (app()->auth()->logged())
                        $select->where('t.privacy_type IN ?', [1, 2]);
                    else
                        $select->where('t.privacy_type = ?', 1);
                    break;
                case 2:
                    break;
            }
        }

        $select->order('created_at', -1);

        return $select->paging($page, $limit);
    }

    /**
     * @return int
     */
    public function getActiveBlogCount()
    {
        return app()->table('platform_blog_post')
            ->select()
            ->count();
    }

    /**
     *Find blog post by id
     *
     * @param string $id
     *
     * @return \Platform\Blog\Model\BlogPost
     */
    public function findPostById($id)
    {
        return app()->table('platform_blog_post')
            ->findById($id);
    }

    /**
     *Find blog post by id
     *
     * @param string $id
     *
     * @return \Platform\Blog\Model\BlogPost
     */
    public function findPost($id)
    {
        return app()->table('platform_blog_post')
            ->findById($id);
    }

    /**
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     * @param array           $data
     *
     * @return \Platform\Blog\Model\BlogPost
     */
    public function addPost(PosterInterface $poster, PosterInterface $parent, $data = [])
    {
        if (empty($data['title']) or empty($data['content']))
            throw new \InvalidArgumentException("Missing parameters  [title, content]");

        // truncate description
        if (empty($data['description']))
            $data['description'] = mb_substr(strip_tags($data['content']), 0, 500);


        $data = array_merge([
            'user_id'        => $poster->getUserId(),
            'poster_id'      => $poster->getId(),
            'poster_type'    => $poster->getType(),
            'parent_id'      => $parent->getId(),
            'parent_type'    => $parent->getType(),
            'parent_user_id' => $parent->getUserId(),
            'created_at'     => KENDO_DATE_TIME,
            'modified_at'    => KENDO_DATE_TIME,
            'module_id'      => 'blog',
        ], $data);

        $post = new BlogPost($data);

        $post->save();

        return $post;
    }

    /***
     * @return array
     */
    public function getAdminCategoryOptions()
    {
        return app()->cacheService()
            ->get(['blog', 'getAdminCategoryOptions'], 0,
                function () {
                    return $this->_getAdminCategoryOptions();
                });
    }

    /**
     * @return array
     */
    private function _getAdminCategoryOptions()
    {
        $select = app()->table('platform_blog_category')
            ->select()
            ->order('category_name', 1);

        $items = $select->all();

        $options = [];

        foreach ($items as $item) {

            if (!$item instanceof BlogCategory)
                continue;

            $options[] = [
                'value' => $item->getId(),
                'label' => $item->getTitle()
            ];
        }

        return $options;
    }

    /**
     * @return array
     */
    public function getCategoryOptions()
    {
        return app()->cacheService()
            ->get(['blog', 'getCategoryOptions'], 0,
                function () {
                    return $this->_getCategoryOptions();
                });

    }


    /**
     * @return array
     */
    private function _getCategoryOptions()
    {
        $select = app()->table('platform_blog_category')
            ->select()
            ->order('category_name', 1);

        $items = $select->all();

        $result = [];

        foreach ($items as $item) {

            if (!$item instanceof BlogCategory)
                continue;

            $result[] = [
                'value' => $item->getId(),
                'label' => $item->getTitle()
            ];
        }

        return $result;
    }
}