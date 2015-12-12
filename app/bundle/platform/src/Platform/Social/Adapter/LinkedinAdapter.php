<?php
namespace Platform\Social\Adapter;

use Platform\LinkedIn\LinkedIn;

/**
 * Class LinkedinAdapter
 *
 * @package Social\Adapter
 */
class LinkedinAdapter implements SocialLoginAdapterInterface
{

    /**
     * @var \Platform\LinkedIn\LinkedIn
     */
    protected $client;

    /**
     * @param $params
     *
     * @return string
     */
    public function getLoginUrl($params = [])
    {
        return $this->getClient()->getLoginUrl([
            LinkedIn::SCOPE_BASIC_PROFILE,
            LinkedIn::SCOPE_EMAIL_ADDRESS,
            LinkedIn::SCOPE_WRITE_SHARE
        ]);
    }

    /**
     * @return \Platform\LinkedIn\LinkedIn
     */
    public function getClient()
    {
        if (null == $this->client) {
            $config = \App::setting('linkedin');

            $this->client = new LinkedIn([
                'api_key'      => $config['client_id'],
                'api_secret'   => $config['client_secret'],
                'callback_url' => $this->getRedirectUrl(),
            ]);

            if (!empty($_SESSION['linkedin_access_token'])) {
                $this->client->setAccessToken($_SESSION['linkedin_access_token']);
            }
        }

        return $this->client;
    }

    /**
     * @param \Base\LinkedIn\LinkedIn $client
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
            'service' => 'linkedin'
        ]);

        return $scheme . '://' . $host . $detailUrl;
    }

    /**
     * @return mixed
     */
    public function getTokenFromRedirect()
    {
        if (!$_GET['code']) {
            return false;
        }

        $token = $this->getClient()->getAccessToken($_GET['code']);

        if (empty($token)) {
            return false;
        }

        $_SESSION['linkedin_access_token'] = $token;

        return $token;
    }

    /**
     * @return mixed
     */
    public function getAccountInfo()
    {
        $token = $this->getClient()->getAccessToken();

        if (empty($token)) {
            throw new \RuntimeException("No LinkedIn Access Token please relogin");
        }

        $fields = implode(',', [
            'id',
            'first-name',
            'last-name',
            'formatted-name',
            'headline',
            'location',
            'industry',
            'picture-url',
            'public-profile-url',
            'email-address',
        ]);


        $me = $this->getClient()->get('/people/~:(' . $fields . ')');

        return [
            'remote_uid'      => $me['id'],
            'remote_service'  => 'linkedin',
            'remote_verified' => true,

            'about'      => $me['headline'],
            'name'       => $me['formattedName'],
            'first_name' => $me['firstName'],
            'last_name'  => $me['lastName'],
            'email'      => $me['emailAddress'],
            'image_url'  => $me['pictureUrl'],
            'linkedin'   => $me['publicProfileUrl'],


        ];
    }

}