<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_user_token`
 */

namespace Platform\User\Model;

/**
 */
use Kendo\Model;

/**
 * Class Platform\UserToken
 *
 * @package Platform\User\Model
 */
class UserToken extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->__get('token_id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('token_id', $value);
    }

    /**
     * @return null|string
     */
    public function getTokenId()
    {
        return $this->__get('token_id');
    }

    /**
     * @param $value
     */
    public function setTokenId($value)
    {
        $this->__set('token_id', $value);
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
    public function getViewerId()
    {
        return $this->__get('viewer_id');
    }

    /**
     * @param $value
     */
    public function setViewerId($value)
    {
        $this->__set('viewer_id', $value);
    }

    /**
     * @return null|string
     */
    public function getViewerType()
    {
        return $this->__get('viewer_type');
    }

    /**
     * @param $value
     */
    public function setViewerType($value)
    {
        $this->__set('viewer_type', $value);
    }

    /**
     * @return null|string
     */
    public function getTimestamp()
    {
        return $this->__get('timestamp');
    }

    /**
     * @param $value
     */
    public function setTimestamp($value)
    {
        $this->__set('timestamp', $value);
    }

    /**
     * @return null|string
     */
    public function getDataText()
    {
        return $this->__get('data_text');
    }

    /**
     * @param $value
     */
    public function setDataText($value)
    {
        $this->__set('data_text', $value);
    }

    /**
     * @return \Platform\User\Model\UserTokenTable
     */
    public function table()
    {
        return \App::table('platform_user_token');
    }
    //END_TABLE_GENERATOR
}