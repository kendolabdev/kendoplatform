<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_review`
 */

namespace Platform\Review\Model;

/**
 */
use Kendo\Model;

/**
 * Class Review
 *
 * @package Review\Model
 */
class Review extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->__get('review_id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('review_id', $value);
    }

    /**
     * @return null|string
     */
    public function getReviewId()
    {
        return $this->__get('review_id');
    }

    /**
     * @param $value
     */
    public function setReviewId($value)
    {
        $this->__set('review_id', $value);
    }

    /**
     * @return null|string
     */
    public function getAboutId()
    {
        return $this->__get('about_id');
    }

    /**
     * @param $value
     */
    public function setAboutId($value)
    {
        $this->__set('about_id', $value);
    }

    /**
     * @return null|string
     */
    public function isActive()
    {
        return $this->__get('is_active');
    }

    /**
     * @return null|string
     */
    public function getActive()
    {
        return $this->__get('is_active');
    }

    /**
     * @param $value
     */
    public function setActive($value)
    {
        $this->__set('is_active', $value);
    }

    /**
     * @return null|string
     */
    public function isApproved()
    {
        return $this->__get('is_approved');
    }

    /**
     * @return null|string
     */
    public function getApproved()
    {
        return $this->__get('is_approved');
    }

    /**
     * @param $value
     */
    public function setApproved($value)
    {
        $this->__set('is_approved', $value);
    }

    /**
     * @return null|string
     */
    public function isPublished()
    {
        return $this->__get('is_published');
    }

    /**
     * @return null|string
     */
    public function getPublished()
    {
        return $this->__get('is_published');
    }

    /**
     * @param $value
     */
    public function setPublished($value)
    {
        $this->__set('is_published', $value);
    }

    /**
     * @return null|string
     */
    public function getPosterId()
    {
        return $this->__get('poster_id');
    }

    /**
     * @param $value
     */
    public function setPosterId($value)
    {
        $this->__set('poster_id', $value);
    }

    /**
     * @return null|string
     */
    public function getUserId()
    {
        return $this->__get('user_id');
    }

    /**
     * @param $value
     */
    public function setUserId($value)
    {
        $this->__set('user_id', $value);
    }

    /**
     * @return null|string
     */
    public function getParentId()
    {
        return $this->__get('parent_id');
    }

    /**
     * @param $value
     */
    public function setParentId($value)
    {
        $this->__set('parent_id', $value);
    }

    /**
     * @return null|string
     */
    public function getParentUserId()
    {
        return $this->__get('parent_user_id');
    }

    /**
     * @param $value
     */
    public function setParentUserId($value)
    {
        $this->__set('parent_user_id', $value);
    }

    /**
     * @return null|string
     */
    public function getAboutType()
    {
        return $this->__get('about_type');
    }

    /**
     * @param $value
     */
    public function setAboutType($value)
    {
        $this->__set('about_type', $value);
    }

    /**
     * @return null|string
     */
    public function getPosterType()
    {
        return $this->__get('poster_type');
    }

    /**
     * @param $value
     */
    public function setPosterType($value)
    {
        $this->__set('poster_type', $value);
    }

    /**
     * @return null|string
     */
    public function getParentType()
    {
        return $this->__get('parent_type');
    }

    /**
     * @param $value
     */
    public function setParentType($value)
    {
        $this->__set('parent_type', $value);
    }

    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->__get('title');
    }

    /**
     * @param $value
     */
    public function setTitle($value)
    {
        $this->__set('title', $value);
    }

    /**
     * @return null|string
     */
    public function getContent()
    {
        return $this->__get('content');
    }

    /**
     * @param $value
     */
    public function setContent($value)
    {
        $this->__set('content', $value);
    }

    /**
     * @return null|string
     */
    public function getScore()
    {
        return $this->__get('score');
    }

    /**
     * @param $value
     */
    public function setScore($value)
    {
        $this->__set('score', $value);
    }

    /**
     * @return null|string
     */
    public function getCreatedAt()
    {
        return $this->__get('created_at');
    }

    /**
     * @param $value
     */
    public function setCreatedAt($value)
    {
        $this->__set('created_at', $value);
    }

    /**
     * @return null|string
     */
    public function getModifiedAt()
    {
        return $this->__get('modified_at');
    }

    /**
     * @param $value
     */
    public function setModifiedAt($value)
    {
        $this->__set('modified_at', $value);
    }

    /**
     * @return \Platform\Review\Model\ReviewTable
     */
    public function table()
    {
        return \App::table('platform_review');
    }
    //END_TABLE_GENERATOR
}