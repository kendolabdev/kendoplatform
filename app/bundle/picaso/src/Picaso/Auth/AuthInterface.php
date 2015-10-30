<?php

namespace Picaso\Auth;

/**
 * Interface AuthInterface
 *
 * @package Picaso\Auth
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