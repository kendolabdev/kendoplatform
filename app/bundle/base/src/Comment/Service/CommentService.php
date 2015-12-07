<?php

namespace Comment\Service;

use Comment\Model\Comment;
use Kendo\Content\AtomInterface;
use Kendo\Content\PosterInterface;

/**
 * Class CommentService
 *
 * @package Activity\Service
 */
class CommentService
{

    /**
     * @return int
     */
    public function getAdminStatisticCount()
    {
        return \App::table('comment')
            ->select()
            ->count();
    }

    /**
     * @param $commentId
     *
     * @return \Comment\Model\Comment
     */
    public function findComment($commentId)
    {
        return \App::table('comment')
            ->select()
            ->where('comment_id=?', $commentId)
            ->one();
    }

    /**
     * @param PosterInterface           $poster
     * @param AtomInterface             $about
     * @param                           $content
     * @param array                     $params
     *
     * @return Comment
     */
    public function add(PosterInterface $poster, AtomInterface $about, $content, $params = [])
    {

        $parent = $about->getParent();

        $params = array_merge([
            'about_id'       => $about->getId(),
            'poster_id'      => $poster->getId(),
            'user_id'        => $poster->getUserId(),
            'about_type'     => $about->getType(),
            'poster_type'    => $poster->getType(),
            'parent_id'      => $parent->getId(),
            'parent_user_id' => $parent->getUserId(),
            'parent_type'    => $parent->getType(),
            'content'        => strip_tags(html_entity_decode($content)),
            'created_at'     => Kendo_DATE_TIME,
            'modified_at'    => Kendo_DATE_TIME,
        ], $params);

        $comment = new Comment($params);

        $comment->save();

        return $comment;
    }

    /**
     * @param AtomInterface $object
     *
     * @return int
     */
    public function getCommentCount(AtomInterface $object)
    {
        return \App::table('comment')
            ->select()
            ->where('about_id=?', $object->getId())
            ->count();

    }

    /**
     * @param  $comment
     *
     * @return bool
     */
    public function remove(Comment $comment)
    {
        $comment->delete();

        return false;
    }

    /**
     * @param AtomInterface $object
     * @param int           $minId
     * @param int           $maxId
     * @param int           $limit
     *
     * @oaran array     $excludes
     *
     * @return \Kendo\Db\SqlSelect
     */
    public function getCommentList(AtomInterface $object = null, $minId = 3, $maxId = 0, $limit = null, $excludes = null)
    {
        $order = \App::setting('activity', 'comment_sort');

        if (null == $object) {
            return [];
        }

        if (null == $limit) {
            $limit = (int)\App::setting('activity', 'comment_limit', 3);
        }
        if ($limit < 1) {
            $limit = 3;
        }

        $select = \App::table('comment')
            ->select()
            ->where('about_id=?', $object->getId());

        if (!empty($excludes)) {
            $select->where('comment_id NOT IN ?', $excludes);
        }

        if ($order == 'time_desc') {
            $select->order('comment_id', 1);
        } else {
            $select->order('comment_id', -1);
        }

        $items = $select->limit($limit, 0)->all();

        return array_reverse($items);
    }

    /**
     * Remove all like entry match `about_id`
     *
     * @param AtomInterface $about
     */
    public function removeAllByAbout(AtomInterface $about)
    {
        \App::table('comment')
            ->delete()
            ->where('about_id=?', $about->getId())
            ->execute();

    }

    /**
     * Remove all like entry match `poster_id`.
     * TODO: How to update `comment_count`
     *
     * @param PosterInterface $poster
     */
    public function removeAllByPoster(PosterInterface $poster)
    {
        \App::table('comment')
            ->delete()
            ->where('poster_id=?', $poster->getId())
            ->orWhere('user_id=?', $poster->getId())
            ->orWhere('parent_id=?', $poster->getId())
            ->orWhere('parent_user_id=?', $poster->getId())
            ->execute();
    }
}