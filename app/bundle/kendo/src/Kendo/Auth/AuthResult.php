<?php

namespace Kendo\Auth;

use User\Model\User;

/**
 * Class AuthResult
 *
 * @package Kendo\Auth
 */
class AuthResult
{

    /**
     * Success
     *
     * @var int
     */
    const SUCCESS = 1;

    /**
     * Invalid username, email
     *
     * @var int
     */
    const INVALID_IDENTITY = 2;

    /**
     * @var int
     */
    const EMPTY_IDENTITY = 3;

    /**
     * @var int
     */
    const EMPTY_CREDENTICAL = 4;

    /**
     * Invalid password
     *
     * @var int
     */
    const INVALID_CREDENTICAL = 5;

    /**
     * User is disabled
     *
     * @var int
     */
    const DISABLED = 6;

    /**
     * User is still un-approval
     *
     * @var int
     */
    const UNAPPROVED = 7;

    /**
     * User is unverified
     *
     * @var int
     */
    const UNVERIFIED = 8;

    /**
     * User is blocked from login
     *
     * @var int
     */
    const BLOCKED = 9;

    /**
     * Unknown error
     *
     * @var int
     */
    const OTHER = 10;

    /**
     * @var int
     */
    private $result;

    /**
     * @var \User\Model\User
     */
    private $user;

    /**
     * This constructor does not allow parametters. <br />
     * Set result explicit by: <br />
     * $AuthResult->setResult(NUMBER) <br />
     *
     * @param int  $result
     * @param User $user
     *
     */
    public function __construct($result = null, $user = null)
    {
        $this->result = self::OTHER;

        if (null !== $result) {
            $this->setResult($result);
        }

        if (null != $user) {
            $this->setUser($user);
        }
    }

    /**
     * Check is valid result
     *
     * @return bool
     */
    public function isValid()
    {
        return (self::SUCCESS == $this->result) && !empty($this->user);
    }

    /**
     * @return int
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set result code
     *
     * @param int $result
     *
     * @return AuthResult
     */
    public function setResult($result)
    {
        $result = (int)$result;
        switch ($result) {
            case self::SUCCESS:
            case self::INVALID_CREDENTICAL:
            case self::INVALID_IDENTITY:
            case self::DISABLED:
            case self::BLOCKED:
            case self::UNVERIFIED:
            case self::UNAPPROVED:
            case self::EMPTY_CREDENTICAL:
            case self::EMPTY_IDENTITY:
                $this->result = $result;
                break;
            default:
                $this->result = self::OTHER;
        }
    }

    /**
     * @return \User\Model\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \User\Model\User $user
     *
     * @return $this
     */
    public function setUser($user)
    {
        if (empty($user)) {
            $this->user = null;
        } else if ($user instanceof User) {
            $this->user = $user;
        } else {
            $this->user = null;
        }


        if (false == $this->user->getActive()) {
            if (!$user->getVerified()) {
                $this->setResult(self::UNVERIFIED);
            } else if (!$user->getApproved()) {
                $this->setResult(self::UNAPPROVED);
            } else {
                $this->setResult(self::DISABLED);
            }
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isInvalidIdentity()
    {
        return $this->result == self::INVALID_IDENTITY;
    }

    /**
     * @return bool
     */
    public function isInvalidCredentical()
    {
        return $this->result == self::INVALID_CREDENTICAL;
    }

    /**
     * @return bool
     */
    public function isBlocked()
    {
        return $this->result == self::BLOCKED;
    }

    /**
     * @return bool
     */
    public function isDisabled()
    {
        return $this->result == self::DISABLED;
    }

    /**
     * @return bool
     */
    public function isUnverfied()
    {
        return $this->result == self::UNVERIFIED;
    }

    /**
     * @return bool
     */
    public function isUnapproved()
    {
        return $this->result == self::UNAPPROVED;
    }

    /**
     * @return bool
     */
    public function isEmptyIdentity()
    {
        return $this->result == self::EMPTY_IDENTITY;
    }

    /**
     * @return bool
     */
    public function isEmptyCredentical()
    {
        return $this->result == self::EMPTY_CREDENTICAL;
    }

}