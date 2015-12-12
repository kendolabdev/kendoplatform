<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_user_auth_password`
 */

namespace Platform\User\Model;

/**
 */
use Kendo\Model;

/**
 * Class Platform\UserAuthPassword
 *
 * @package Platform\User\Model
 */
class UserAuthPassword extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->__get('password_id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('password_id', $value);
    }

    /**
     * @return null|string
     */
    public function getPasswordId()
    {
        return $this->__get('password_id');
    }

    /**
     * @param $value
     */
    public function setPasswordId($value)
    {
        $this->__set('password_id', $value);
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
    public function getEnctype()
    {
        return $this->__get('enctype');
    }

    /**
     * @param $value
     */
    public function setEnctype($value)
    {
        $this->__set('enctype', $value);
    }

    /**
     * @return null|string
     */
    public function getHash()
    {
        return $this->__get('hash');
    }

    /**
     * @param $value
     */
    public function setHash($value)
    {
        $this->__set('hash', $value);
    }

    /**
     * @return null|string
     */
    public function getSalt()
    {
        return $this->__get('salt');
    }

    /**
     * @param $value
     */
    public function setSalt($value)
    {
        $this->__set('salt', $value);
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
     * @return \Platform\User\Model\UserAuthPasswordTable
     */
    public function table()
    {
        return \App::table('platform_user_auth_password');
    }
    //END_TABLE_GENERATOR
}