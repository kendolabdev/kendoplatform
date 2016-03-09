<?php

namespace Platform\Follow\Service;

use Kendo\Kernel\KernelService;
use Platform\Follow\Model\Follow;
use Kendo\Content\PosterInterface;


/**
 * Class FollowService
 *
 * @package Activity\Service
 */
class FollowService extends KernelService
{
    /**
     * Not following
     */
    const NOT_FOLLOW = 0;

    /**
     * Is Following
     */
    const IS_FOLLOWING = 1;

    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadFollowPaging($query = [], $page = 1, $limit = 12)
    {
        $select = app()->table('platform_follow')->select();

        $isValid = false;

        if (!empty($query['parentId'])) {
            $select->where('parent_id=?', $query['parentId']);
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
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     *
     * @return \Platform\Follow\Model\Follow
     */
    public function findFollow(PosterInterface $poster, PosterInterface $parent)
    {
        return app()->table('platform_follow')
            ->select()
            ->where('parent_id=?', $parent->getId())
            ->where('poster_id=?', $poster->getId())
            ->one();
    }

    /**
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     *
     * @return bool
     */
    public function toggle(PosterInterface $poster, PosterInterface $parent)
    {
        if ($poster->getId() == $parent->getId()) {
            throw new \InvalidArgumentException("Could not follow by themself");
        }

        $follow = $this->findFollow($poster, $parent);

        if ($follow) {
            $this->remove($poster, $parent, $follow);
        } else {
            $this->add($poster, $parent);
        }

        return true;
    }

    /**
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     * @param Follow          $follow
     *
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function add(PosterInterface $poster, PosterInterface $parent, Follow $follow = null)
    {
        if ($poster->getId() == $parent->getId()) {
            throw new \InvalidArgumentException("Could not follow by themself");
        }

        if (null === $follow) {
            $follow = $this->findFollow($poster, $parent);
        }

        if (null == $follow) {
            $follow = new Follow([
                'poster_id'   => $poster->getId(),
                'parent_id'   => $parent->getId(),
                'poster_type' => $poster->getType(),
                'parent_type' => $parent->getType(),
                'created_at'  => KENDO_DATE_TIME,
            ]);

            $follow->save();

            return true;
        }

        return false;
    }

    /**
     * @param  PosterInterface $poster
     * @param  PosterInterface $parent
     * @param  Follow          $follow
     *
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function remove(PosterInterface $poster, PosterInterface $parent, Follow $follow = null)
    {

        if ($poster->getId() == $parent->getId()) {
            throw new \InvalidArgumentException("Could not follow by themself");
        }

        if (null == $follow) {
            $follow = $this->findFollow($poster, $parent);
        }

        if (null != $follow) {
            $follow->delete();

            return true;
        }

        return false;
    }

    /**
     * posterId follow parent id ?
     *
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     *
     * @return bool
     */
    public function isFollowed($poster, $parent)
    {
        return null != $this->findFollow($poster, $parent);
    }


    /**
     * Who is followed by posterId
     *
     * @param  int $posterId
     *
     * @return array
     */
    public function getFollowedIdList($posterId)
    {
        $response = app()->table('platform_follow')
            ->select()
            ->where('poster_id=?', $posterId)
            ->toInts('parent_id');

        $response[] = $posterId;

        return $response;
    }

    /**
     * Follow what ?
     *
     * @param  int $parentId
     *
     * @return array
     */
    public function getFollowedById($parentId)
    {
        $response = app()->table('platform_follow')
            ->select()
            ->where('parent_id=?', $parentId)
            ->one('poster_id');

        $response[] = $parentId;

        return $response;
    }

    /**
     * @param $posterId
     *
     * @return \Kendo\Db\SqlSelect
     */
    public function getFollowedSelect($posterId)
    {
        return app()->table('platform_follow')
            ->select()
            ->where('poster_id=?', $posterId);
    }

    /**
     * @param PosterInterface $poster
     * @param array           $itemIdList
     *
     * @return array
     */
    public function getListFollowStatus(PosterInterface $poster, $itemIdList)
    {
        if (null == $poster || empty($itemIdList)) {
            return [];
        }

        $response = [];

        foreach ($itemIdList as $id) {
            $response[ $id ] = self::NOT_FOLLOW;
        }

        $posterId = $poster->getId();

        $resultList = app()->table('platform_follow')
            ->select()
            ->where('poster_id=?', $posterId)
            ->where('parent_id IN ?', $itemIdList)
            ->fields('parent_id');

        foreach ($resultList as $id) {
            $response[ $id ] = self::IS_FOLLOWING;
        }

        return $response;
    }

    /**
     * @param PosterInterface $poster
     * @param                 $parentId
     *
     * @return int
     */
    public function getFollowStatus(PosterInterface $poster = null, $parentId)
    {
        if (null == $poster || empty($parentId)) {
            return self::NOT_FOLLOW;
        }

        $result = app()->table('platform_follow')
            ->select()
            ->where('poster_id=?', $poster->getId())
            ->where('parent_id = ?', $parentId)
            ->fields('parent_id');

        if ($result) {
            return self::IS_FOLLOWING;
        }

        return self::NOT_FOLLOW;
    }

    /**
     * @param $parentId
     *
     * @return \Kendo\Db\SqlSelect
     */
    public function getFollowedBySelect($parentId)
    {
        return app()->table('platform_follow')
            ->select()
            ->where('parent_id=?', $parentId);
    }

    /**
     * @param string $viewerId
     * @param string $alias
     *
     * @return string
     */
    public function getFollowingConditionForQuery($viewerId, $alias = 'f')
    {
        return strtr(':alias.poster_id=:viewerId OR :alias.poster_id IN (SELECT parent_id FROM :prefix_platform_follow WHERE poster_id=:viewerId)', [
            ':alias'    => $alias,
            ':prefix_'  => app()->db()->getPrefix(),
            ':viewerId' => (string)$viewerId
        ]);
    }

    /**
     * @param PosterInterface $poster
     */
    public function removeAllByPoster($poster)
    {
        app()->table('platform_follow')
            ->delete()
            ->where('parent_id=?', $poster->getId())
            ->orWhere('poster_id=?', $poster->getId())
            ->execute();

    }
}