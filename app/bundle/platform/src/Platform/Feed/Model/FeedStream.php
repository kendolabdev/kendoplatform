<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_feed_stream`
 */

namespace Platform\Feed\Model;

/**
 */
use Kendo\Model;

/**
 * Class FeedStream
 *
 * @package Feed\Model
 */
class FeedStream extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getProfileId()
    {
        return $this->__get('profile_id');
    }

    /**
     * @param $value
     */
    public function setProfileId($value)
    {
        $this->__set('profile_id', $value);
    }

    /**
     * @return null|string
     */
    public function getFeedId()
    {
        return $this->__get('feed_id');
    }

    /**
     * @param $value
     */
    public function setFeedId($value)
    {
        $this->__set('feed_id', $value);
    }

    /**
     * @return null|string
     */
    public function getProfileType()
    {
        return $this->__get('profile_type');
    }

    /**
     * @param $value
     */
    public function setProfileType($value)
    {
        $this->__set('profile_type', $value);
    }

    /**
     * @return null|string
     */
    public function getFeedType()
    {
        return $this->__get('feed_type');
    }

    /**
     * @param $value
     */
    public function setFeedType($value)
    {
        $this->__set('feed_type', $value);
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
    public function getPrivacyType()
    {
        return $this->__get('privacy_type');
    }

    /**
     * @param $value
     */
    public function setPrivacyType($value)
    {
        $this->__set('privacy_type', $value);
    }

    /**
     * @return null|string
     */
    public function getPrivacyValue()
    {
        return $this->__get('privacy_value');
    }

    /**
     * @param $value
     */
    public function setPrivacyValue($value)
    {
        $this->__set('privacy_value', $value);
    }

    /**
     * @return null|string
     */
    public function getParamsText()
    {
        return $this->__get('params_text');
    }

    /**
     * @param $value
     */
    public function setParamsText($value)
    {
        $this->__set('params_text', $value);
    }

    /**
     * @return null|string
     */
    public function isHidden()
    {
        return $this->__get('is_hidden');
    }

    /**
     * @return null|string
     */
    public function getHidden()
    {
        return $this->__get('is_hidden');
    }

    /**
     * @param $value
     */
    public function setHidden($value)
    {
        $this->__set('is_hidden', $value);
    }

    /**
     * @return \Platform\Feed\Model\FeedStreamTable
     */
    public function table()
    {
        return \App::table('platform_feed_stream');
    }
    //END_TABLE_GENERATOR
}