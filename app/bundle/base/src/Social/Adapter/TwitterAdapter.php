<?php

namespace Social\Adapter;

use TijsVerkoyen\Twitter\Twitter;


/**
 * Class TwitterAdapter
 *
 * @package Social\Adapter
 */
class TwitterAdapter implements SocialLoginAdapterInterface
{

    /**
     * @var Twitter
     */
    protected $client;

    /**
     * @param $params
     *
     * @return string
     */
    public function getLoginUrl($params = [])
    {
        try {
            $client = $this->getClient();

            /**
             * reset client
             */
            $client->setOAuthToken(null);
            $client->setOAuthTokenSecret(null);

            $response = $client->oAuthRequestToken($this->getRedirectUrl());

            $token = $response['oauth_token'];

            return Twitter::SECURE_API_URL . '/oauth/authorize?oauth_token=' . $token;

        } catch (\Exception $ex) {

        }

    }

    /**
     * @return Twitter
     */
    public function getClient()
    {
        if (null == $this->client) {

            $config = \App::setting('twitter');

            $client = new Twitter($config['consumer_key'], $config['consumer_secret']);

            if (!empty($_SESSION['twitter_access_token'])) {
                $token = $_SESSION['twitter_access_token'];

                $client->setOAuthToken($token['oauth_token']);
                $client->setOAuthTokenSecret($token['oauth_token_secret']);
            }
            $this->client = $client;
        }

        return $this->client;
    }

    /**
     * @param Twitter $client
     */
    public function setClient($client)
    {
        $this->client = $client;
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
            'service' => 'twitter'
        ]);

        return $scheme . '://' . $host . $detailUrl;
    }

    /**
     * @return mixed
     */
    public function getTokenFromRedirect()
    {
        if (empty($_GET['oauth_token']) || empty($_GET['oauth_verifier'])) {
            return false;
        }

        $client = $this->getClient();

        $token = $client->oAuthAccessToken($_GET['oauth_token'], $_GET['oauth_verifier']);

        if (empty($token)) {
            return false;
        }

        if (empty($token['oauth_token'])
            || empty($token['oauth_token_secret'])
            || empty($token['user_id'])
        ) {
            return false;
        }


        $_SESSION['twitter_access_token'] = $token;

        return $token;
    }

    /**
     * @return mixed
     */
    public function getAccountInfo()
    {
        $client = $this->getClient();

        $me = $client->accountVerifyCredentials(false, true);

        $name = $me['name'];

        list($firstName, $lastName) = explode(' ', $name, 2);

        return [
            'remote_uid'      => $me['id'],
            'remote_service'  => 'twitter',
            'remote_verified' => $me['verified'],

            'email'           => '',
            'name'            => $name,
            'first_name'      => $firstName,
            'last_name'       => $lastName,
            'profile_name'    => $me['screen_name'],
            'location'        => $me['location'],
            'about'           => $me['description'],
            'image_url'       => $me['profile_image_url'],
            'locale'          => $me['lang'],
            'twitter'         => $me['screen_name'],
        ];
    }

}