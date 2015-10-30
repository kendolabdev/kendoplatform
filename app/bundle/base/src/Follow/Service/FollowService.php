<?php

namespace Follow\Service;

use Follow\Model\Follow;
use Picaso\Content\Poster;


/**
 * Class FollowService
 *
 * @package Activity\Service
 */
class FollowService
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
     * @return \Picaso\Paging\PagingInterface
     */
    public function loadFollowPaging($query = [], $page = 1, $limit = 12)
    {
        $select = \App::table('follow')->select();

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
     * @param Poster $poster
     * @param Poster $parent
     *
     * @return \Follow\Model\Follow
     */
    public function findFollow(Poster $poster, Poster $parent)
    {
        return \App::table('follow')
            ->select()
            ->where('parent_id=?', $parent->getId())
            ->where('poster_id=?', $poster->getId())
            ->one();
    }

    /**
     * @param Poster $poster
     * @param Poster $parent
     *
     * @return bool
     */
    public function toggle(Poster $poster, Poster $parent)
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
     * @param Poster $poster
     * @param Poster $parent
     * @param Follow $follow
     *
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function add(Poster $poster, Poster $parent, Follow $follow = null)
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
                'created_at'  => PICASO_DATE_TIME,
            ]);

            $follow->save();

            return true;
        }

        return false;
    }

    /**
     * @param  Poster $poster
     * @param  Poster $parent
     * @param  Follow $follow
     *
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function remove(Poster $poster, Poster $parent, Follow $follow = null)
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
     * @param Poster $poster
     * @param Poster $parent
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
        $response = \App::table('follow')
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
        $response = \App::table('follow')
            ->select()
            ->where('parent_id=?', $parentId)
            ->one('poster_id');

        $response[] = $parentId;

        return $response;
    }

    /**
     * @param $posterId
     *
     * @return \Picaso\Db\SqlSelect
     */
    public function getFollowedSelect($posterId)
    {
        return \App::table('follow')
            ->select()
            ->where('poster_id=?', $posterId);
    }

    /**
     * @param Poster $poster
     * @param array  $itemIdList
     *
     * @return array
     */
    public function getListFollowStatus(Poster $poster, $itemIdList)
    {
        if (null == $poster || empty($itemIdList)) {
            return [];
        }

        $response = [];

        foreach ($itemIdList as $id) {
            $response[ $id ] = self::NOT_FOLLOW;
        }

        $posterId = $poster->getId();

        $resultList = \App::table('follow')
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
     * @param Poster $poster
     * @param        $parentId
     *
     * @return int
     */
    public function getFollowStatus(Poster $poster = null, $parentId)
    {
        if (null == $poster || empty($parentId)) {
            return self::NOT_FOLLOW;
        }

        $result = \App::table('follow')
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
     * @return \Picaso\Db\SqlSelect
     */
    public function getFollowedBySelect($parentId)
    {
        return \App::table('follow')
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
        return strtr(':alias.poster_id=:viewerId OR :alias.poster_id IN (SELECT parent_id FROM :prefix_follow WHERE poster_id=:viewerId)', [
            ':alias'    => $alias,
            ':prefix_'  => \App::db()->getPrefix(),
            ':viewerId' => (string)$viewerId
        ]);
    }

    /**
     * @param Poster $poster
     */
    public function removeAllByPoster($poster)
    {
        \App::table('follow')
            ->delete()
            ->where('parent_id=?', $poster->getId())
            ->orWhere('poster_id=?', $poster->getId())
            ->execute();

    }
}