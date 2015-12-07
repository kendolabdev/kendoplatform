<?php

namespace User\Auth;

use Kendo\Auth\AuthException;
use Kendo\Auth\AuthStorageInterface;
use Kendo\Content\PosterInterface;
use User\Model\User;
use User\Model\UserToken;

/**
 * Class AuthStorage
 *
 * @package User\Auth
 */
class AuthStorage implements AuthStorageInterface
{
    CONST TOKEN_LENGTH = 32;

    /**
     * Auth cookie name
     *
     * @var string
     */
    private $cookieName;

    /**
     * Auth cookie path
     *
     * @var string
     */
    private $cookiePath;

    /**
     *
     * @var int
     */
    private $lifetime;

    /**
     *
     * @var int
     */
    private $rememberLifetime;

    /**
     * Store current authenticate state
     *
     * @param      $user
     * @param bool $remember
     *
     * @return bool
     */
    public function store($user, $remember = false)
    {

        if (!$user instanceof User) {
            throw new AuthException("Could not store none user");
        }

        // Run command line
        if (Kendo_CLI) {
            return false;
        }

        // Header is already sents
        if (headers_sent()) {
            throw new AuthException("Header is already sent");
        }

        $tokenId = $this->makeToken();

        // save to session storage.

        $userId = $user->getId();

        $dataText = json_encode([
            'user_id' => $userId,
        ]);

        $token = new UserToken([
            'token_id'  => $tokenId,
            'user_id'   => $userId,
            'timestamp' => time(),
            'data_text' => $dataText,
        ]);

        $token->save();

        setcookie($this->getCookieName(), $tokenId, $this->getExpire($remember), $this->getCookiePath());

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
        if (Kendo_CLI) {
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


        if (!$tokenEntry instanceof UserToken) {
            return false;
        }

        $userId = $tokenEntry->getUserId();

        if (empty($userId)) {
            return false;
        }

        $userEntry = \App::table('user')
            ->findById($userId);

        if (empty($userEntry) or !$userEntry instanceof User) {
            return false;
        }


        \App::authService()
            ->setUser($userEntry);

        $viewerEntry = null;

        /**
         *
         */
        if ($tokenEntry->getViewerId() && $tokenEntry->getViewerType()) {
            $viewerEntry = \App::find($tokenEntry->getViewerType(), $tokenEntry->getViewerId());
        }

        if (!$viewerEntry) {
            $viewerEntry = $userEntry;
        }

        \App::authService()
            ->setViewer($viewerEntry);

        // process user by entry then process load but there are nothing to loose fromt this touch
    }

    /**
     * Forget current authenticate state
     */
    public function forget()
    {
        if (Kendo_CLI) {
            return false;
        }

        if (headers_sent()) {
            return false;
        }

        setcookie($this->getCookieName(), '', $this->getExpire(), $this->getCookiePath());
    }

    /**
     * @param $poster
     *
     * @return bool
     */
    public function saveViewer($poster)
    {
        // Run command line
        if (Kendo_CLI) {
            return false;
        }

        if (!$poster instanceof PosterInterface) {
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


        if (!$tokenEntry instanceof UserToken) {
            return false;
        }

        $tokenEntry->setViewerId($poster->getId());

        $tokenEntry->setViewerType($poster->getType());

        $tokenEntry->save();

        return true;
    }

    /**
     * @return int
     */
    public function getLifetime()
    {
        if (null == $this->lifetime) {
            $this->lifetime = (int)\App::setting('core', 'auth_life_time', 86400);
        }

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
        if (null == $this->rememberLifetime) {
            $this->rememberLifetime = \App::setting('core', 'auth_remember_lifetime', 2592000);
        }

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
        if (null == $this->cookieName) {
            $this->cookieName = \App::setting('core', 'auth_cookie_name', 'psau');
        }

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
        if (null == $this->cookiePath) {
            $this->cookiePath = \App::setting('core', 'auth_cookie_path', '/');
        }

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
}