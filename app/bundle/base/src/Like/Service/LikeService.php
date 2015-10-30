<?php

namespace Like\Service;

use Feed\Model\Feed;
use Like\Helper\LikeResult;
use Like\Model\Like;
use Picaso\Content\CanLike;
use Picaso\Content\Content;
use Picaso\Content\Poster;

/**
 * Class LikeService
 *
 * @package Like\Service
 */
class LikeService
{
    /**
     * IS UN-LIKE
     */
    const NOT_LIKE = 0;

    /**
     * IS LIKED
     */
    const IS_LIKED = 1;

    /**
     * @return int
     */
    public function getAdminStatisticCount()
    {
        return \App::table('like')
            ->select()
            ->count();
    }

    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Picaso\Paging\PagingInterface
     */
    public function loadLikePaging($query = [], $page = 1, $limit = 12)
    {
        $select = \App::table('like')->select();

        $isValid = false;

        if (!empty($query['parentId'])) {
            $select->where('about_id=?', $query['parentId']);
            $isValid = true;
        }

        if (!empty($query['posterId'])) {
            $select->where('poster_id=?', $query['posterId']);
            $isValid = true;
        }

        if (!$isValid) {
            throw new \InvalidArgumentException();
        }

        return $select->paging($page, $limit);

    }


    /**
     * @param Poster          $poster
     * @param CanLike|Content $about
     *
     * @return \Like\Model\Like
     */
    public function findLike(Poster $poster, $about)
    {
        return \App::table('like')
            ->select()
            ->where('poster_id=?', $poster->getId())
            ->where('about_id=?', $about->getId())
            ->one();
    }

    /**
     * @param Poster          $poster
     * @param CanLike|Content $about
     *
     * @return bool  Return isLiked status
     */
    public function toggle(Poster $poster, $about)
    {
        $like = $this->findLike($poster, $about);

        if ($like) {
            $like->delete();
        } else {
            $this->add($poster, $about);
        }
    }

    /**
     * @param Poster          $poster
     * @param CanLike|Content $about
     *
     * @return bool
     */
    public function add(Poster $poster, $about)
    {
        if ($about instanceof Feed)
            $about = $about->getAbout();

        $like = new Like([
            'about_id'    => $about->getId(),
            'poster_id'   => $poster->getId(),
            'about_type'  => $about->getType(),
            'poster_type' => $poster->getType(),
            'created_at'  => PICASO_DATE_TIME,
        ]);
        $like->save();
    }

    /**
     * @param Poster          $poster
     * @param CanLike|Content $about
     *
     * @return bool
     */
    public function remove(Poster $poster, $about)
    {
        $like = $this->findLike($poster, $about);

        if ($like)
            $like->delete();
    }

    /**
     * @param Poster  $poster
     * @param CanLike $about
     *
     * @return bool
     */
    public function isLiked($poster, $about)
    {
        return null != $this->findLike($poster, $about);
    }

    /**
     * @param Poster          $poster
     * @param CanLike|Content $about
     * @param int             $limit
     *
     * @return LikeResult
     */
    public function getLikeResult(Poster $poster = null, $about, $limit = 3)
    {

        if (null == $poster)
            $poster = \App::auth()->getViewer();

        $isLiked = false;

        $likeCount = $about->getLikeCount();

        if ($poster && $likeCount) {
            $isLiked = $this->isLiked($poster, $about);
        }

        $sample = [];

        if ($isLiked) {
        }

        if ($likeCount > 0) {

            $select = \App::table('like')
                ->select()
                ->where('about_id=?', $about->getId())
                ->where('about_type=?', $about->getType())
                ->limit($limit, 0);

            if ($poster != null) {
                $select->where('poster_id <>?', $poster->getId());
            }

            foreach ($select->all() as $like) {

                if (!$like instanceof Like) continue;

                if (null != ($likedPoster = $like->getPoster())) {
                    $sample[] = $likedPoster;
                }
            }
        }

        return new LikeResult($isLiked, $likeCount, $sample, $about);
    }

    /**
     * @param $posterId
     *
     * @return \Picaso\Db\SqlSelect
     */
    public function getLikedSelect($posterId)
    {
        return \App::table('like')
            ->select()
            ->where('poster_id=?', $posterId);
    }

    /**
     * @param $objectId
     *
     * @return \Picaso\Db\SqlSelect
     */
    public function getLikedBySelect($objectId)
    {
        return \App::table('like')
            ->select()
            ->where('about_id=?', $objectId);
    }

    /**
     * @param Poster $poster
     * @param array  $itemIdList
     *
     * @return array
     */
    public function getListLikeStatus(Poster $poster, $itemIdList)
    {
        if (null == $poster || empty($itemIdList)) {
            return [];
        }

        $response = [];

        foreach ($itemIdList as $id) {
            $response[ $id ] = self::NOT_LIKE;
        }

        $posterId = $poster->getId();

        $resultList = \App::table('like')
            ->select()
            ->where('poster_id=?', $posterId)
            ->where('about_id IN ?', $itemIdList)
            ->fields('about_id');

        foreach ($resultList as $id) {
            $response[ $id ] = self::IS_LIKED;
        }

        return $response;
    }


    /**
     * @param Poster $poster
     * @param        $objectId
     *
     * @return int
     */
    public function getLikeStatus(Poster $poster = null, $objectId)
    {
        if (null == $poster || empty($objectId)) {
            return self::NOT_LIKE;
        }

        $result = \App::table('like')
            ->select()
            ->where('poster_id=?', $poster->getId())
            ->where('about_id = ?', $objectId)
            ->fields('about_id');

        if ($result) {
            return self::IS_LIKED;
        }

        return self::NOT_LIKE;
    }

    /**
     * @param $attachmentIdList
     */
    public function getSampleList($attachmentIdList)
    {

    }

    /**
     * Remove all like entry match `about_id`
     *
     * @param CanLike|Content $about
     */
    public function removeAllByAbout($about)
    {
        \App::table('like')
            ->delete()
            ->where('about_id=?', $about->getId())
            ->execute();
    }

    /**
     * Remove all like entry match `poster_id`
     * TODO: How to update `like_count`
     *
     * @param Poster $poster
     */
    public function removeAllByPoster($poster)
    {
        $table = \App::table('like');

        $table->partialUpdateWhenPosterRemove($poster, 'like_count', '-1', 100, function () use (&$table, &$poster) {
            return
                $table->select()
                    ->where('poster_id=?', $poster->getId())
                    ->orWhere('user_id=?', $poster->getId())
                    ->orWhere('parent_id=?', $poster->getId())
                    ->orWhere('parent_user_id=?', $poster->getId())
                    ->columns('distinct(about_type) as tt')
                    ->fields('tt');
        }, function ($type, $limit) use (&$table, &$poster) {
            return $table
                ->select()
                ->where('poster_id=?', $poster->getId())
                ->where('about_type=?', $type)
                ->limit($limit, 0)
                ->fields('about_id');
        }, function ($idList) use (&$table, &$poster) {
            \App::table('like')
                ->delete()
                ->where('poster_id=?', $poster->getId())
                ->where('about_id IN ?', $idList);
        });
    }

    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Picaso\Paging\PagingInterface
     */
    public function loadLikedThisPaging($query = [], $page = 1, $limit = 10)
    {
        $select = \App::table('like')
            ->select()
            ->where('about_type=?', $query['aboutType'])
            ->where('about_id=?', $query['aboutId'])
            ->order('poster_id', 1);

        return $select->paging($page, $limit);

    }

}