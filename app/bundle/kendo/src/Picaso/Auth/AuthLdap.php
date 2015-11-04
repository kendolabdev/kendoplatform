<?php

namespace Picaso\Auth;

/**
 * Class AuthLdap
 *
 * @package Picaso\Auth
 */
class AuthLdap implements AuthInterface
{

    /**
     * @param array $params
     *
     * @return AuthResult
     */
    public function auth(array $params)
    {
        // TODO: Implement auth() method.
        return new AuthResult();
    }
}