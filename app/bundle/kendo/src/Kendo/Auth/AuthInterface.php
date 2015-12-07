<?php

namespace Kendo\Auth;

/**
 * Interface AuthInterface
 *
 * @package Kendo\Auth
 */
interface AuthInterface
{

    /**
     * @param array $params
     *
     * @return AuthResult
     */
    public function auth(array $params);

}