<?php

namespace Social\Adapter;

/**
 * include window live login
 */
include_once Kendo_VENDOR_DIR . '/windowlive/windowslivelogin.php';

/**
 * Class WindowAdapter
 *
 * @package Social\Adapter
 */
class WindowAdapter implements SocialLoginAdapterInterface
{
    /**
     * @var
     */
    private $client;

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * @var string
     */
    private $redirectUrl;

    /**
     * @var string
     */
    private $oauthUrl = 'https://login.live.com/oauth20_token.srf';

    /**
     *
     */
    function __construct()
    {
        $config = \App::setting('window');

        $this->setClientId($config['client_id']);
        $this->setClientSecret($config['client_secret']);
    }

    /**
     * @param $params
     *
     * @return string
     */
    public function getLoginUrl($params = [])
    {
        $query = http_build_query([
            'client_id'       => $this->getClientId(),
            'display'         => 'page',
            'locale'          => 'en',
            'redirect_uri'    => $this->getRedirectUrl(),
            'response_type'   => 'code',
            'scope'           => 'wl.signin,wl.basic,wl.emails',
            'redirect_type'   => 'auth',
            'request_ts'      => time(),
            'response_method' => 'cookie',
            'secure_cookie'   => 0
        ], null, '&');

        return 'https://login.live.com/oauth20_authorize.srf?' . $query;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return string
     */
    public function getRedirectUrl()
    {
        if (null == $this->redirectUrl) {
            $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : null;
            $scheme = isset($_SERVER['HTTP_SCHEME']) ? $_SERVER['HTTP_SCHEME'] : null;

            if (empty($scheme)) {
                $scheme = 'http';
            }

            if (empty($host)) {
                $host = 'localhost';
            }

            $detailUrl = \App::routingService()->getUrl('oauth_callback', [
                'service' => 'window'
            ]);

            $this->redirectUrl = $scheme . '://' . $host . $detailUrl;
        }

        return $this->redirectUrl;

    }

    /**
     * @return mixed
     */
    public function getTokenFromRedirect()
    {
        if (empty($_GET['code'])) {
            return false;
        }

        $token = $this->requestAccessTokenByVerifier($_GET['code']);

        if (empty($token)) {
            return false;
        }

        $_SESSION['window_access_token'] = $token;

        return $token;
    }

    /**
     * @param $verifier
     *
     * @return bool|array
     */
    protected function requestAccessTokenByVerifier($verifier)
    {
        return $this->requestAccessToken([
            'client_id'     => $this->getClientId(),
            'redirect_uri'  => $this->getRedirectUrl(),
            'client_secret' => $this->getClientSecret(),
            'code'          => $verifier,
            'grant_type'    => 'authorization_code'
        ]);
    }

    /**
     * @param $content
     *
     * @return bool|mixed
     */
    protected function requestAccessToken($content)
    {
        $response = $this->sendRequest(
            $this->oauthUrl,
            'POST',
            $content);

        if ($response !== false) {
            $authToken = json_decode($response, true);
            if (!empty($authToken) && !empty($authToken['access_token'])) {
                return $authToken;
            }
        }

        return false;
    }

    /**
     * @param        $url
     * @param string $method
     * @param array  $data
     * @param array  $headers
     *
     * @return mixed
     */
    protected function sendRequest($url,
                                   $method = 'GET',
                                   $data = [],
                                   $headers = [])
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data, null, '&'));
        }

        $curlResponse = curl_exec($ch);

        curl_close($ch);

        return $curlResponse;

    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param string $clientSecret
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }

    /**
     * @return mixed
     */
    public function getAccountInfo()
    {
        if (empty($_SESSION['window_access_token'])) {
            throw new \RuntimeException("Invalid window live access token");
        }

        $token = $_SESSION['window_access_token'];

        $access_token = $token['access_token'];

        $responseText = $this->sendRequest('https://apis.live.net/v5.0/me?access_token=' . $access_token);

        $result = json_decode($responseText, true);

        list($language) = explode('_', $result['locale']);

        $profile = [
            'remote_uid'      => $result['id'],
            'remote_service'  => 'window',
            'remote_verified' => true,

            'name'            => $result['name'],
            'first_name'      => $result['first_name'],
            'last_name'       => $result['last_name'],
            'email'           => $result['emails']['preferred'],
            'locale'          => $result['locale'],
            'gender'          => $result['gender'],
            'language'        => $language

        ];

        return $profile;

    }

    /**
     * @param $refreshToken
     *
     * @return bool|array
     */
    protected function requestAccessTokenByRefreshToken($refreshToken)
    {
        return $this->requestAccessToken([
            'client_id'     => $this->getClientId(),
            'redirect_uri'  => $this->getRedirectUrl(),
            'client_secret' => $this->getClientSecret(),
            'refresh_token' => $refreshToken,
            'grant_type'    => 'refresh_token'
        ]);
    }

}