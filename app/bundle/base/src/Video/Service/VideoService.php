<?php

namespace Video\Service;

use Kendo\Content\PosterInterface;
use Kendo\Request\HttpRequest;
use Video\Model\Video;
use Video\Model\VideoCategory;
use Video\Provider\ProviderInterface;
use Video\Provider\Vimeo;
use Video\Provider\Youtube;

/**
 * Class VideoService
 *
 * @package Video\Service
 */
class VideoService
{

    /**
     * @param string $id
     *
     * @return \Video\Model\VideoCategory
     */
    public function findCategoryById($id)
    {
        return \App::table('video.video_category')
            ->findById(intval($id));
    }

    /**
     * @param array $data
     *
     * @return \Video\Model\VideoCategory
     */
    public function addCategory($data = [])
    {

        if (empty($data['category_name']))
            throw new \InvalidArgumentException("Missing params [category_name]");

        $entry = new VideoCategory($data);

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
        $select = \App::table('video.video_category')->select('t');

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
    public function loadVideoPaging($query = [], $page = 1, $limit = 10)
    {

        $select = \App::table('video')->select();

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
        } else {
            // check published & approved type of data.
        }

        $select->order('created_at', -1);

        return $select->paging($page, $limit);
    }

    /**
     * @param Video  $video
     * @param  array $context
     *
     * @return string
     * @throws \Exception
     */
    public function getEmbedCode(Video $video, $context)
    {
        return $this->getProvider($video->getProviderCode())->getEmbedCode($video->getVideoCode(), $context);
    }

    /**
     * @param $code
     *
     * @return ProviderInterface
     * @throws \Exception
     */
    public function getProvider($code)
    {
        switch ($code) {
            case 'youtube':
                return new Youtube();
            case 'vimeo':
                return new Vimeo();
        }
        throw new \Exception("Video does not support this provider");
    }

    /**
     * @param HttpRequest     $request
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     *
     * @return \Feed\Model\Feed
     */
    public function addFromActivityComposer(HttpRequest $request, PosterInterface $poster, PosterInterface $parent)
    {
        $privacy = $request->getArray('privacy');

        $privacyType = 1;
        $privacyValue = 1;

        if (!empty($privacy)) {
            $privacyType = $privacy['type'];
            $privacyValue = $privacy['value'];
        }

        $statusTxt = $request->getString('statusTxt');

        $data = $request->getArray('video');
        $data['story'] = $statusTxt;

        $video = $this->addVideo($poster, $parent, $data, $privacyType, $privacyValue);

        $needUpdate = false;

        $place = $request->getArray('place');

        if (!empty($place)) {
            $video->setPlace($place);
            $needUpdate = true;
        }

        $people = $request->getArray('people');

        if (!empty($people)) {
            $video->setPeople($people);
            $needUpdate = true;
        }

        if ($needUpdate) {
            $video->save();
        }

        $feed = \App::feedService()->addItemFeed('video_shared', $video);

        return $feed;
    }

    /**
     * @param HttpRequest     $request
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     *
     * @return \Feed\Model\Feed
     */
    public function addFromCommentComposer(HttpRequest $request, PosterInterface $poster, PosterInterface $parent)
    {
        $privacy = $request->getArray('privacy');

        $privacyType = 1;
        $privacyValue = 1;

        if (!empty($privacy)) {
            $privacyType = $privacy['type'];
            $privacyValue = $privacy['value'];
        }

        $data = $request->getArray('video');

        $video = $this->addVideo($poster, $parent, $data, $privacyType, $privacyValue);

        return $video;

    }

    /**
     * @return int
     */
    public function getActiveVideoCount()
    {
        return \App::table('video')
            ->select()
//            ->where('is_published=?', 1)
            ->count();
    }

    /**
     * @param string $id
     *
     * @return \Video\Model\Video
     */
    public function findVideo($id)
    {
        return \App::table('video')
            ->findById($id);
    }

    /**
     * @param $url
     *
     * @return \Video\Provider\ParseResult
     */
    public function parseFromUrl($url)
    {
        $info = parse_url($url);

        $host = strtolower($info['host']);


        $delegate = null;

        switch (true) {
            case strpos($host, 'youtube') !== false:
                $delegate = new Youtube();
                break;
            case strpos($host, 'vimeo') !== false:
                $delegate = new Vimeo();
                break;
        }

        if (null == $delegate)
            throw new \InvalidArgumentException("Video url does not support");


        return $delegate->parseFromUrl($url);

    }

    /**
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     * @param array           $params
     * @param int             $privacyType
     * @param int             $privacyValue
     *
     * @return Video
     */
    public function addVideo(PosterInterface $poster, PosterInterface $parent, $params = [], $privacyType = null, $privacyValue = null)
    {
        if (null === $privacyType || null === $privacyValue) {
            $privacyType = RELATION_TYPE_ANYONE;
            $privacyValue = RELATION_TYPE_ANYONE;
        }

        $data = array_merge([
            'user_id'        => $poster->getUserId(),
            'poster_id'      => $poster->getId(),
            'poster_type'    => $poster->getType(),
            'parent_id'      => $parent->getId(),
            'parent_type'    => $parent->getType(),
            'parent_user_id' => $parent->getUserId(),
            'module_id'      => 'video',
            'privacy_type'   => $privacyType,
            'privacy_value'  => $privacyValue,
            'created_at'     => Kendo_DATE_TIME,
            'modified_at'    => Kendo_DATE_TIME,
        ], $params);

        $video = new Video($data);

        $video->save();

        return $video;
    }

    /**
     * @return array
     */
    public function getCategoryOptions()
    {

        return \App::cacheService()
            ->get(['video', 'getCategoryOptions'], 0, function () {
                return $this->_getCategoryOptions();
            });

    }


    /**
     * @return array
     */
    private function _getCategoryOptions()
    {
        $select = \App::table('video.video_category')->select()
            ->order('category_name', 1);

        $items = $select->all();

        $options = [];

        foreach ($items as $item) {
            if (!$item instanceof VideoCategory) continue;
            $options[] = ['value' => $item->getId(), 'label' => $item->getTitle()];
        }

        return $options;
    }
}