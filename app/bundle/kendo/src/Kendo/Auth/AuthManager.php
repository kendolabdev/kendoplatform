<?php

namespace Kendo\Auth;


use Platform\User\Model\User;
use Platform\User\Model\UserToken;


/**
 * Class AuthManager
 *
 * @package Kendo\Auth
 */
class AuthManager
{
    CONST TOKEN_LENGTH = 32;

    /**
     * @var string
     */
    private $token = '';

    /**
     * Auth cookie name
     *
     * @var string
     */
    private $cookieName = 'psau';

    /**
     * Auth cookie path
     *
     * @var string
     */
    private $cookiePath = '/';

    /**
     * Keep alive within 1 day
     *
     * @var int
     */
    private $lifetime = 86400;

    /**
     * Keep alive within 30 days
     *
     * @var int
     */
    private $rememberLifetime = 2592000;

    /**
     * @param string $adapter
     * @param array  $params
     *
     * @return AuthResult
     * @throws AuthException
     */
    public function login($adapter, $params)
    {
        $result = $this->getAdapter($adapter)->auth($params);

        if ($result->isValid()) {
            $this->store($result);
            \App::authService()->setViewer($result->getUser());
        } else {
            $this->forget();
            \App::authService()->setViewer(null);
        }

        return $result;
    }

    /**
     * Store current authenticate state
     *
     * @param AuthResult $result
     * @param bool       $remember
     *
     * @return bool
     */
    public function store(AuthResult $result, $remember = false)
    {

        // Invalid result
        if (!$result->isValid()) {
            return false;
        }

        // Header is already sents
        if (headers_sent()) {
            return false;
        }

        // Run command line
        if (KENDO_CLI) {
            return false;
        }

        $tokenId = $this->makeToken();

        // save to session storage.

        $this->saveTokenData($result, $tokenId);

        setcookie($this->getCookieName(), $tokenId, $this->getExpire($remember), $this->getCookiePath());

        return true;
    }

    /**
     * Save auth result to user_token table
     *
     * @param AuthResult $result
     * @param string     $tokenId
     *
     * @return bool
     */
    private function saveTokenData(AuthResult $result, $tokenId)
    {
        $userId = $result->getUser()->getId();

        $dataText = json_encode([
            'user_id' => $userId,
        ]);

        $userToken = new UserToken([
            'token_id'  => $tokenId,
            'user_id'   => $userId,
            'timestamp' => time(),
            'data_text' => $dataText,
        ]);

        $userToken->save();

        return true;
    }

    /**
     * Restore last session authenticate state
     *
     * @return bool
     */
    public function restore()
    {
        // Run command line
        if (KENDO_CLI) {
            return false;
        }

        $cookieName = $this->getCookieName();

        if (empty($_COOKIE[ $cookieName ])) {
            return false;
        }

        $tokenId = (string)$_COOKIE[ $cookieName ];

        if (empty($tokenId)) {
            return false;
        }

        $tokenEntry = \App::table('user.user_token')
            ->findById($tokenId);

        if (null == $tokenEntry) {
            return false;
        }

        $userId = $tokenEntry->getUserId();

        if (empty($userId)) {
            return false;
        }

        $userEntry = \App::table('platform_user')
            ->findById($userId);

        if (empty($userEntry) or !$userEntry instanceof User) {
            return false;
        }


        \App::authService()
            ->setUser($userEntry);

        // process user by entry then process load but there are nothing to loose fromt this touch
    }

    /**
     * Forget current authenticate state
     */
    public function forget()
    {
        if (KENDO_CLI) {
            return false;
        }

        if (headers_sent()) {
            return false;
        }

        setcookie($this->getCookieName(), '', $this->getExpire(), $this->getCookiePath());
    }

    /**
     * @return int
     */
    public function getLifetime()
    {
        return $this->lifetime;
    }

    /**
     * @param int $lifetime
     */
    public function setLifetime($lifetime)
    {
        $this->lifetime = $lifetime;
    }

    /**
     * @return int
     */
    public function getRememberLifetime()
    {
        return $this->rememberLifetime;
    }

    /**
     * @param int $rememberLifetime
     */
    public function setRememberLifetime($rememberLifetime)
    {
        $this->rememberLifetime = $rememberLifetime;
    }

    /**
     * @return string
     */
    public function getCookieName()
    {
        return $this->cookieName;
    }

    /**
     * @param string $cookieName
     */
    public function setCookieName($cookieName)
    {
        $this->cookieName = $cookieName;
    }

    /**
     * @return string
     */
    public function getCookiePath()
    {
        return $this->cookiePath;
    }

    /**
     * @param string $cookiePath
     */
    public function setCookiePath($cookiePath)
    {
        $this->cookiePath = $cookiePath;
    }

    /**
     * @param bool $remember
     *
     * @return int
     */
    public function getExpire($remember = false)
    {
        return time() + ($remember ? $this->getRememberLifetime() : $this->getLifetime());
    }

    /**
     * @return string
     */
    public function getToken()
    {
        if (null == $this->token) {
            $this->token = $this->makeToken();
        }

        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    private function makeToken()
    {
        $seeks = '1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
        $max = strlen($seeks) - 1;
        $response = '';

        for ($index = 0; $index < self::TOKEN_LENGTH; ++$index) {
            $response .= substr($seeks, mt_rand(0, $max), 1);
        }

        return $response;
    }

    /**
     * Clear current logged state
     */
    public function logout()
    {
        $this->forget();
    }
}