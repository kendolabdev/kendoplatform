<?php

namespace Platform\Help\Service;

use Kendo\Kernel\KernelServiceAgreement;
use Platform\Help\Model\HelpCategory;
use Platform\Help\Model\HelpPage;
use Platform\Help\Model\HelpPost;
use Platform\Help\Model\HelpTopic;

/**
 * Class HelpService
 *
 * @package Help\Service
 */
class HelpService extends KernelServiceAgreement
{

    /**
     * @return array
     */
    public function loadAdminTopicOptions()
    {
        return \App::cacheService()
            ->get(['HelpService', 'loadAdminTopicOptions', ''], 0, function () {
                return $this->_loadTopicOptions();
            });
    }

    /**
     * @return array
     */
    public function loadAdminCategoryOptions()
    {
        return \App::cacheService()
            ->get(['HelpService', 'loadAdminCategoryOptions', ''], 0, function () {
                return $this->_loadCategoryOptions();
            });
    }

    /**
     * @return array
     */
    public function _loadTopicOptions()
    {
        $options = [];

        $select = \App::table('help.help_topic')->select()
            ->order('topic_title', 1);

        $items = $select->all();

        foreach ($items as $item) {
            if (!$item instanceof HelpTopic) continue;
            $options[] = ['value' => $item->getId(), 'label' => $item->getTitle()];
        }

        return $options;
    }


    /**
     * @return array
     */
    public function _loadCategoryOptions()
    {
        $options = [];

        $select = \App::table('help.help_category')->select()
            ->order('category_name', 1);

        $items = $select->all();

        foreach ($items as $item) {
            if (!$item instanceof HelpCategory) continue;
            $options[] = ['value' => $item->getId(), 'label' => $item->getTitle()];
        }

        return $options;
    }

    /**
     * @param array $data
     *
     * @return \Platform\Help\Model\HelpPage
     */
    public function addHelpPage($data = [])
    {

        if (empty($data['page_title']) || empty($data['page_content']))
            throw new \InvalidArgumentException("Missing parameters [page_title,page_content]");

        $data = array_merge([
            'page_active'     => 1,
            'page_sort_order' => 100,
            'page_content'    => '',
            'page_slug'       => '',
            'page_title'      => 'page_content',
            'created_at'      => KENDO_DATE_TIME,
            'updated_at'      => KENDO_DATE_TIME,
        ], $data);

        $cat = new HelpPage($data);
        $cat->save();

        return $cat;
    }

    /**
     * @param array $data
     *
     * @return \Platform\Help\Model\HelpTopic
     */
    public function addHelpPost($data = [])
    {

        if (empty($data['topic_id']) || empty($data['post_title']) || empty($data['post_content']) || empty($data['post_description']))
            throw new \InvalidArgumentException("Missing parameters [topic_id,post_title,post_content,post_description]");

        $data = array_merge([
            'post_active'     => 1,
            'post_sort_order' => 100,
            'post_slug'       => '',
            'created_at'      => KENDO_DATE_TIME,
            'updated_at'      => KENDO_DATE_TIME,
        ], $data);

        $cat = new HelpPost($data);
        $cat->save();

        return $cat;
    }


    /**
     * @param array $data
     *
     * @return \Platform\Help\Model\HelpTopic
     */
    public function addHelpTopic($data = [])
    {

        if (empty($data['category_id']) || empty($data['topic_title']) || empty($data['topic_description']))
            throw new \InvalidArgumentException("Missing parameters [category_name]");

        $data = array_merge([
            'topic_active'     => 1,
            'topic_sort_order' => 100,
            'topic_slug'       => '',
            'created_at'       => KENDO_DATE_TIME,
        ], $data);

        $cat = new HelpTopic($data);
        $cat->save();

        return $cat;
    }

    /**
     * @param array $data
     *
     * @return \Platform\Help\Model\HelpCategory
     */
    public function addHelpCategory($data = [])
    {

        if (empty($data['category_name']))
            throw new \InvalidArgumentException("Missing parameters [category_name]");

        $data = array_merge([
            'category_active'     => 1,
            'category_sort_order' => 100,
            'category_slug'       => '',
            'created_at'          => KENDO_DATE_TIME,
        ], $data);

        $cat = new HelpCategory($data);
        $cat->save();

        return $cat;
    }

    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadAdminPagePaging($query = [], $page = 1, $limit = 10)
    {

        $select = \App::table('help.help_page')
            ->select();

        if (!empty($query['q']))
            $select->where('page_title like ?', '%' . $query['q'] . '%');

        return $select->paging($page, $limit);
    }

    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadAdminCategoryPaging($query = [], $page = 1, $limit = 10)
    {

        $select = \App::table('help.help_category')
            ->select();

        if (!empty($query)) ;

        return $select->paging($page, $limit);
    }

    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadAdminTopicPaging($query = [], $page = 1, $limit = 10)
    {

        $select = \App::table('help.help_topic')
            ->select();

        if (!empty($query['category']))
            $select->where('category_id=?', (string)$query['category']);

        if (!empty($query['q']))
            $select->where('topic_title like ?', '%' . $query['q'] . '%');


        return $select->paging($page, $limit);
    }

    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadAdminPostPaging($query = [], $page = 1, $limit = 10)
    {

        $select = \App::table('help . help_post')
            ->select();

        if (!empty($query['topic']))
            $select->where('topic_id =?', (string)$query['topic']);

        if (!empty($query['q']))
            $select->where('post_title like ?', '%' . $query['q'] . '%');

        return $select->paging($page, $limit);
    }

    /**
     * Load help category pagination
     *
     * @param array $context
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadCategoryPaging($context = [], $page = 1, $limit = 10)
    {
        $select = \App::table('help . help_category')
            ->select()
            ->order('category_sort_order', 1);

        if (!empty($context['active'])) {
            $select->where('category_active =?', 1);
        }

        return $select->paging($page, $limit);
    }

    /**
     * Load help topic pagination
     *
     * @param array $context
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadTopicPaging($context = [], $page = 1, $limit = 10)
    {
        $select = \App::table('help . help_topic')
            ->select()
            ->order('topic_sort_order', 1);

        if (!empty($context['categoryId'])) {
            $select->where('category_id =?', $context['categoryId']);
        }

        if (!empty($context['active'])) {
            $select->where('topic_active =?', 1);
        }

        return $select->paging($page, $limit);
    }


    /**
     * Load helps post pagination
     *
     * @param array $context
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     *
     */
    public function loadPostPaging($context = [], $page = 1, $limit = 10)
    {
        $select = \App::table('help . help_post')
            ->select()
            ->order('post_sort_order', 1);

        if (!empty($context['topicId'])) {
            $select->where('topic_id =?', $context['topicId']);
        }

        if (!empty($context['active'])) {
            $select->where('post_active =?', 1);
        }

        return $select->paging($page, $limit);


    }


    /**
     * @param $categoryId
     *
     * @return \Kendo\Model
     */
    public function findCategoryById($categoryId)
    {
        return \App::table('help . help_category')
            ->findById($categoryId);
    }

    /**
     * @param string $slug
     *
     * @return \Platform\Help\Model\HelpCategory
     */
    public function findCategoryBySlug($slug)
    {
        return \App::table('help . help_category')
            ->select()
            ->where('category_slug =?', (string)$slug)
            ->one();
    }

    /**
     * @param string $slug
     *
     * @return \Platform\Help\Model\HelpCategory
     */

    public function findCategory($slug)
    {
        return \App::table('help . help_category')
            ->select()
            ->where('category_slug =?', (string)$slug)
            ->orWhere('category_id =?', (string)$slug)
            ->one();
    }

    /**
     * @param $topicId
     *
     * @return \Platform\Help\Model\HelpTopic
     */
    public function findTopicById($topicId)
    {
        return \App::table('help . help_topic')
            ->findById($topicId);
    }

    /**
     * @param string $slug
     *
     * @return \Platform\Help\Model\HelpTopic
     */
    public function findTopicBySlug($slug)
    {
        return \App::table('help . help_topic')
            ->select()
            ->where('topic_slug =?', (string)$slug)
            ->one();
    }

    /**
     * @param string $slug
     *
     * @return \Platform\Help\Model\HelpTopic
     */

    public function findTopic($slug)
    {
        return \App::table('help . help_topic')
            ->select()
            ->where('topic_slug =?', (string)$slug)
            ->orWhere('topic_id =?', (string)$slug)
            ->one();
    }

    /**
     * @param $postId
     *
     * @return \Platform\Help\Model\HelpPost
     */
    public function findPostById($postId)
    {
        return \App::table('help . help_post')
            ->findById($postId);
    }

    /**
     * @param $slug
     *
     * @return \Platform\Help\Model\HelpPost
     */
    public function findPostBySlug($slug)
    {
        return \App::table('help . help_post')
            ->select()
            ->where('post_slug =?', (string)$slug)
            ->one();
    }

    /**
     * @param $slug
     *
     * @return \Platform\Help\Model\HelpPost
     */
    public function findPost($slug)
    {
        return \App::table('help . help_post')
            ->select()
            ->where('post_slug =?', (string)$slug)
            ->orWhere('post_id =?', (string)$slug)
            ->one();
    }

    /**
     * @param $pageId
     *
     * @return \Platform\Help\Model\HelpPage
     */
    public function findPageById($pageId)
    {
        return \App::table('help . help_page')
            ->findById($pageId);
    }

    /**
     * @param $slug
     *
     * @return \Platform\Help\Model\HelpPage
     */
    public function findPageBySlug($slug)
    {
        return \App::table('help . help_page')
            ->select()
            ->where('page_slug =?', (string)$slug)
            ->one();
    }

    /**
     * @param $slug
     *
     * @return \Platform\Help\Model\HelpPage
     */
    public function findPage($slug)
    {
        return \App::table('help . help_page')
            ->select()
            ->where('page_slug =?', (string)$slug)
            ->orWhere('page_id =?', (string)$slug)
            ->one();
    }

    /**
     * @param bool $active
     *
     * @return array
     */
    public function getListCategory($active)
    {
        $select = \App::table('help . help_category')
            ->select()
            ->order('category_sort_order', 1);

        if (null !== $active) {
            $select->where('category_active =?', 1);
        }

        return $select->all();
    }

    /**
     * @param string $categoryId
     * @param bool   $active
     *
     * @return array
     */
    public function getListTopicInCategory($categoryId, $active = null)
    {
        $select = \App::table('help . help_topic')
            ->select()
            ->where('category_id =?', $categoryId)
            ->order('topic_sort_order', 1);

        if (null !== $active) {
            $select->where('topic_active =?', $active ? 1 : 0);
        }

        return $select->all();
    }

    /**
     * @param string $topicId
     * @param bool   $active
     *
     * @return array
     */
    public function getListPostInTopic($topicId, $active = null)
    {
        $select = \App::table('help . help_post')
            ->select()
            ->where('topic_id =?', $topicId)
            ->order('post_sort_order', 1);

        if (null !== $active) {
            $select->where('post_active =?', 1);
        }

        return $select->all();


    }
}