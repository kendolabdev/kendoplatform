<?php

namespace User\Auth;

use Picaso\Auth\AuthInterface;
use Picaso\Auth\AuthResult;
use User\Model\User;

/**
 * Class AuthPassword
 *
 * @package Picaso\Auth
 */
class AuthPassword implements AuthInterface
{

    /**
     * @var string
     */
    const KEY_IDENTITY = 'identity';

    /**
     * @var string
     */
    const KEY_CREDENTIAL = 'credential';

    /**
     * @param array $params Required "identity", "credential"
     *
     * @return AuthResult
     */
    public function auth(array $params)
    {

        $identity = @$params['identity'];
        $credentital = @$params['credential'];


        if (empty($identity)) {
            return new AuthResult(AuthResult::EMPTY_IDENTITY);
        }

        // Missing password
        if (empty($credentital)) {
            return new AuthResult(AuthResult::EMPTY_CREDENTICAL);
        }

        $user = \App::table('user')
            ->select()
            ->where('profile_name=?', $identity)
            ->orWhere('email=?', $identity)
            ->one();

        if (null == $user || !$user instanceof User) {
            return new AuthResult(AuthResult::INVALID_IDENTITY);
        }

        $userId = $user->getId();

        $enctypes = \App::auth()->getSupportHashTypes();

        $rows = \App::table('user.user_auth_password')
            ->select()
            ->where('user_id=?', $userId)
            ->where('is_active=?', 1)
            ->where('enctype=?', $enctypes)
            ->toAssocs();

        foreach ($rows as $row) {
            $hash = \App::auth()->getHashGenerator($row['enctype']);

            if ($hash->getHash($credentital, $row['salt']) == $row['hash']) {
                return new AuthResult(AuthResult::SUCCESS, $user);
            }
        }

        return new AuthResult(AuthResult::INVALID_CREDENTICAL);
    }
}