<?php

namespace Kendo\PushNotification;

/**
 * Class GoogleSender
 *
 * @package Kendo\PushNotification
 */
class GoogleSender implements PushSenderInterface
{

    /**
     * Url of google could messge to send
     */
    CONST GOOGLE_GCM_ENDPOINT = 'https://android.googleapis.com/gcm/send';

    /**
     * @var bool
     */
    private $debug = false;

    /**
     * @var string
     */
    private $apiKey = '';

    /**
     * @var int
     */
    private $timeout = 30;


    /**
     * Require params key, debug
     *
     * @param array $params
     */
    public function __construct($params)
    {
        if (isset($params['debug'])) {
            $this->setDebug($params['debug']);
        }

        if (isset($params['api_key'])) {
            $this->setApiKey($params['api_key']);
        }

        if (isset($params['timeout'])) {
            $this->setTimeout($params['timeout']);
        }
    }

    /**
     * @param PushMessage $message
     * @param array       $idList
     *
     * @return bool
     * @throws PushException
     */
    public function send(PushMessage $message, $idList = [])
    {
        $aData = $this->prepareMessageToSend($message);

        $fields = [
            'registration_ids' => $idList,
            'data'             => $aData,
        ];

        $headers = [
            'Authorization: key=' . $this->getApiKey(),
            'Content-Type: application/json'
        ];

        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, self::GOOGLE_GCM_ENDPOINT);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->getTimeout());
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $response = curl_exec($ch);

        curl_close($ch);

        if (false == $response) {
            if ($this->isDebug()) {
                throw new PushException("Could not send message via Google Cloud Message");
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * @param PushMessage $message
     *
     * @return mixed
     */
    private function prepareMessageToSend(PushMessage $message)
    {
        return $message->__toString();
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @param int $timeout
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    /**
     * @return boolean
     */
    public function isDebug()
    {
        return $this->debug;
    }

    /**
     * @param boolean $debug
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;
    }

}