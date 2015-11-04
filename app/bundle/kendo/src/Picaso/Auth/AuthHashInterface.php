<?php
namespace Picaso\Auth;

/**
 * Class DefaultHashGenerator
 *
 * @package Picaso\Auth
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