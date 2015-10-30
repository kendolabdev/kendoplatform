<?php

namespace User\Auth;

use Picaso\Auth\AuthInterface;
use Picaso\Auth\AuthResult;
use User\Model\User;


/**
 * Class AuthRemote
 *
 * @package Picaso\Auth
 */
class AuthRemote implements AuthInterface
{

    /**
     * String
     */
    const KEY_IDENTITY = 'uid';

    /**
     * String
     */
    const KEY_SERVICE = 'service';

    /**
     * @param array $params
     *
     * @return AuthResult
     */
    public function auth(array $params)
    {
        if (empty($params['identity'])) {
            return new AuthResult(AuthResult::EMPTY_IDENTITY);
        }

        if (empty($params['credential'])) {
            return new AuthResult(AuthResult::EMPTY_CREDENTICAL);
        }

        $user = $this->findUser($params['identity'], $params['credential']);

        if (!$user instanceof User) {
            return new AuthResult(AuthResult::INVALID_IDENTITY);
        }

        if (empty($user)) {
            return new AuthResult(AuthResult::INVALID_IDENTITY);
        }

        return new AuthResult(AuthResult::SUCCESS, $user);
    }

    /**
     * @param $uid
     * @param $service
     *
     * @return null|string
     */
    protected function findUser($uid, $service)
    {

        $remoteUser = \App::table('user.use_auth_remote')
            ->select()
            ->where('remote_uid=:uid and remote_service = :service', [
                ':uid'     => (string)$uid,
                ':service' => (string)$service,
            ])
            ->one();


        if (!$remoteUser) {
            return null;
        }

        if (!$remoteUser->getUserId()) {
            return null;
        }

        return \App::table('user')
            ->select()
            ->where('user_id=?', $remoteUser->getUserId())
            ->one();
    }
}