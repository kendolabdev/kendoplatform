<?php
namespace Platform\Social\Adapter;

/**
 * Class GoogleAdapter
 *
 * @package Social\Adapter
 */
class GoogleAdapter implements SocialLoginAdapterInterface
{
    /**
     * @var \Google_Client
     */
    protected $client;

    /**
     * @param $params
     *
     * @return string
     */
    public function getLoginUrl($params = [])
    {
        $client = $this->getClient();

        $client->setScopes([
            "https://www.googleapis.com/auth/userinfo#email",
            "https://www.googleapis.com/auth/userinfo.profile"
        ]);

        return $this->getClient()->createAuthUrl();

    }

    /**
     * @return \Google_Client
     */
    public function getClient()
    {
        if (null == $this->client) {

            $config = \App::setting('google');

            $client = new \Google_Client();

            $client->setApplicationName($config['project_name']);
            $client->setDeveloperKey($config['public_key']);

            $client->setClientId($config['client_id']);
            $client->setClientSecret($config['client_secret']);

            $client->setRedirectUri($this->getRedirectUrl());

            if (!empty($_SESSION['google_access_token'])) {
                $client->setAccessToken($_SESSION['google_access_token']);
            }

            $this->client = $client;
        }

        return $this->client;
    }

    /**
     * @param \Google_Client $client
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

        $detailUrl = \App::routingService()->getUrl('oauth_callback', [
            'service' => 'google'
        ]);

        return $scheme . '://' . $host . $detailUrl;
    }

    /**
     * @return mixed
     */
    public function getTokenFromRedirect()
    {
        $client = $this->getClient();

        if (!empty($_GET['code'])) {
            $client->authenticate($_GET['code']);
        }

        $token = $client->getAccessToken();

        if (empty($token)) {
            return false;
        }

        $_SESSION['google_access_token'] = $token;

        return $token;


    }

    /**
     * @return mixed
     */
    public function getAccountInfo()
    {
        $client = $this->getClient();

        if (!$client->getAccessToken()) {
            throw new \RuntimeException("No google access token");
        }

        $oauth2 = new \Google_Service_Oauth2($client);

        $me = $oauth2->userinfo->get();

        return [
            'remote_uid'      => $me->getId(),
            'remote_service'  => 'google',
            'remote_verified' => $me->getVerifiedEmail(),
            'google'          => $me->getLink(),

            'email'           => $me->getEmail(),
            'name'            => $me->getName(),
            'first_name'      => $me->getGivenName(),
            'last_name'       => $me->getFamilyName(),
            'locale'          => $me->getLocale(),
            'gender'          => $me->getGender(),
            'image_url'       => $me->getPicture(),

        ];

    }


}