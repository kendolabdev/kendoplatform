<?php

namespace Kendo\Auth;

/**
 * Class DefaultHashGenerator
 *
 * @package Kendo\Auth
 */
class DefaultHashGenerator implements AuthHashInterface
{

    /**
     * @param string $password
     * @param string $salt
     *
     * @return string
     * @throws AuthException
     */
    public function getHash($password, $salt)
    {
        if (!defined('KENDO_SECRET_KEY'))
            throw new AuthException("Please setup secret key");

        return sha1(sprintf('%s.%s.%s', $password, KENDO_SECRET_KEY, $salt));
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return (string)uniqid();
    }
}