<?php

namespace Platform\User\Auth;

use Kendo\Auth\AuthInterface;
use Kendo\Auth\AuthResult;
use Platform\User\Model\User;


/**
 * Class AuthRemote
 *
 * @package Kendo\Auth
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

        $remoteUser = app()->table('user.use_auth_remote')
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

        return app()->table('platform_user')
            ->select()
            ->where('user_id=?', $remoteUser->getUserId())
            ->one();
    }
}