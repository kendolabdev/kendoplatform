<?php

namespace Platform\Review\Service;

use Kendo\Content\ContentInterface;
use Kendo\Content\PosterInterface;
use Platform\Review\Model\Review;

/**
 * Class ReviewService
 *
 * @package Review\Service
 */
class ReviewService
{

    const MIN_SCORE = 1;

    const MAX_SCORE = 5;

    /**
     * @param int $posterId
     * @param int $objectId
     *
     * @return \Platform\Review\Model\Review
     */
    public function findReview($posterId, $objectId)
    {
        return \App::table('activity.review')
            ->select()
            ->where('poster_id=?', $posterId)
            ->where('object_id=?', $objectId)
            ->one();
    }

    /**
     * @param PosterInterface  $poster
     * @param ContentInterface $object
     * @param         $score
     * @param         $content
     * @param array            $params
     *
     * @return bool
     */
    public function add(PosterInterface $poster, ContentInterface $object, $score, $content, $params = [])
    {

        $score = (int)$score;

        if ($score < self::MIN_SCORE || $score > self::MAX_SCORE) {
            throw new \InvalidArgumentException(strtr(
                'invalid score value :score (min: :min, max: :max)', [
                    ':score' => $score,
                    ':min'   => self::MIN_SCORE,
                    ':max'   => self::MAX_SCORE,
                ]
            ));
        }

        $reivew = $this->findReview($poster->getId(), $object->getId());

        if (null == $reivew) {
            $params = array_merge([
                'object_id'   => $object->getId(),
                'poster_id'   => $poster->getId(),
                'object_type' => $object->getType(),
                'poster_type' => $poster->getType(),
                'score'       => $score,
                'content'     => $content,
                'created_at'  => KENDO_DATE_TIME,
                'modified_at' => KENDO_DATE_TIME,
            ], $params);

            $reivew = new Review($params);

            $reivew->save();

            return true;
        }

        return false;
    }

    /**
     * @param PosterInterface  $poster
     * @param ContentInterface $object
     *
     * @return bool
     */
    public function remove(PosterInterface $poster, ContentInterface $object)
    {
        $review = $this->findReview($poster->getId(), $object->getId());

        if (null != $review) {
            $review->delete();
        }

        return false;
    }

    /**
     * @param int $posterId
     * @param int $objectId
     *
     * @return bool
     */
    public function isReviewed($posterId, $objectId)
    {
        return null != $this->findReview($posterId, $objectId);
    }

    /**
     * @param $posterId
     *
     * @return \Kendo\Db\SqlSelect
     */
    public function getReviewedSelect($posterId)
    {
        return \App::table('activity.review')
            ->select()
            ->where('poster_id=?', $posterId);
    }

    /**
     * @param $objectId
     *
     * @return \Kendo\Db\SqlSelect
     */
    public function getReviewedBySelect($objectId)
    {
        return \App::table('activity.review')
            ->select()
            ->where('object_id=?', $objectId);
    }
}