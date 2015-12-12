<?php
namespace Kendo\Auth;

/**
 * Class DefaultHashGenerator
 *
 * @package Kendo\Auth
 */
interface AuthHashInterface
{
    /**
     * @param string $password
     * @param string $salt
     *
     * @return string
     * @throws AuthException
     */
    public function getHash($password, $salt);

    /**
     * @return string
     */
    public function getSalt();
}