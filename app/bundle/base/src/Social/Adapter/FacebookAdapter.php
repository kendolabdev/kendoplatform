<?php
namespace Social\Adapter;

use Facebook\Authentication\AccessToken;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Facebook\Helpers\FacebookRedirectLoginHelper;


/**
 * Class FacebookAdapter
 *
 * @package Social\Adapter
 */
class FacebookAdapter implements SocialLoginAdapterInterface
{

    /**
     * @var Facebook
     */
    private $facebook;

    /**
     * Key used on session token
     */
    const FACEBOOK_SESSION_KEY = 'facebook_access_token';

    /**
     * init facebook app
     */
    public function __construct()
    {
        $config = \App::setting('facebook');

        $this->facebook = new Facebook([
            'app_id'                => $config['app_id'],
            'app_secret'            => $config['secret'],
            'default_graph_version' => 'v2.2'
        ]);

        if (!empty($_SESSION[ self::FACEBOOK_SESSION_KEY ]))
            $this->facebook->setDefaultAccessToken($_SESSION[ self::FACEBOOK_SESSION_KEY ]);
    }

    /**
     * @return string
     */
    public function getRedirectUrl()
    {
        $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : null;
        $scheme = isset($_SERVER['HTTP_SCHEME']) ? $_SERVER['HTTP_SCHEME'] : null;

        if (empty($scheme)) {
            $scheme = 'http';
        }

        if (empty($host)) {
            $host = 'localhost';
        }

        $detailUrl = \App::routing()->getUrl('oauth_callback', [
            'service' => 'facebook'
        ]);

        return $scheme . '://' . $host . $detailUrl;
    }

    /**
     * @return FacebookRedirectLoginHelper
     */
    public function getLoginHelper()
    {
        return $this->facebook->getRedirectLoginHelper();
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function getLoginUrl($params = [])
    {
        $scopes = [
            'email'
        ];

        $scopes = array_unique($scopes);

        return $this->getLoginHelper()->getLoginUrl($this->getRedirectUrl(), $scopes);
    }

    /**
     * This implementation follow instruction
     *
     * @see https://developers.facebook.com/docs/php/gettingstarted/5.0.0
     *
     * @return AccessToken
     */
    public function getTokenFromRedirect()
    {
        $token = null;

        try {
            $token = $this->getLoginHelper()->getAccessToken($this->getRedirectUrl());

            // exchange a long-live access token

            $oAuth2Client = $this->facebook->getOAuth2Client();

            $token = $oAuth2Client->getLongLivedAccessToken($token);

        } catch (FacebookResponseException $e) {
            throw new \RuntimeException('Graph returned an error: ' . $e->getMessage());
        } catch (FacebookSDKException $e) {
            // When validation fails or other local issues
            throw new \RuntimeException('Facebook SDK returned an error: ' . $e->getMessage());
        }

        if (!$token instanceof AccessToken)
            throw new \RuntimeException('Could not authorize request on Facebook');

        // store access token
        $_SESSION[ self::FACEBOOK_SESSION_KEY ] = $token->__toString();

        $this->facebook->setDefaultAccessToken($token);

        return $token;
    }

    /**
     *
     */
    public function getAccountInfo()
    {
        try {

            $response = $this->facebook->get('/me');

            $me = $response->getGraphUser();

            // Output user name.
            return [
                'remote_uid'      => $me->getId(),
                'remote_service'  => 'facebook',
                'remote_verified' => true,
                'email'           => $me->getField('email'),
                'name'            => $me->getName(),
                'facebook'        => $me->getLink(),
                'first_name'      => $me->getFirstName(),
                'last_name'       => $me->getLastName(),
                'gender'          => $me->getGender(),
                'timezone'        => $me->getField('timezone'),
                'locale'          => $me->getField('locale'),
                'bod'             => $me->getBirthday(),
            ];

        } catch (\Exception $ex) {

            // Some other error occurred.
            throw new \RuntimeException($ex->getMessage());
        }
    }
}