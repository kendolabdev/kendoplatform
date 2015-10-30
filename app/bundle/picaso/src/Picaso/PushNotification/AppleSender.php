<?php

namespace Picaso\PushNotification;

/**
 * Class AppleSender
 *
 * @package Picaso\PushNotification
 */
class AppleSender implements PushSenderInterface
{


    CONST APPLE_APN_ENDPOINT = 'ssl://gateway.push.apple.com:2195';


    /**
     * @var string
     */
    private $certificate = '';

    /**
     * @var string
     */
    private $passPhrase = '';

    /**
     * @var bool
     */
    private $debug = false;

    /**
     * @var int
     */
    private $timeout = 50000;

    /**
     * @param array $params
     */
    public function __construct($params)
    {
        if (isset($params['debug'])) {
            $this->setDebug($params['debug']);
        }

        if (isset($params['certificate'])) {
            $this->setCertificate($params['certificate']);
        }

        if (isset($params['passphrase'])) {
            $this->setPassPhrase($params['passphrase']);
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
     */
    public function send(PushMessage $message, $idList = [])
    {
        $fp = $this->connect();

        if (!$fp) {
            return false;
        }

        $payload = $this->prepareMessageToSend($message);

        foreach ($idList as $recipient) {
            $msg = chr(0) . pack('n', 32) . pack('H*', $recipient) . pack('n', strlen($payload)) . $payload;
            fwrite($fp, $msg, strlen($msg));
        }

        fclose($fp);

        return true;
    }

    /**
     * @return bool|resource
     * @throws PushException
     */
    public function connect()
    {
        $streamContextParams = ['ssl' => [
            'local_cert' => $this->getCertificate(),
            'passphrase' => $this->getPassPhrase(),
        ]];

        $context = stream_context_create($streamContextParams);
        $error = 0;
        $message = '';

        $fp = stream_socket_client(self::APPLE_APN_ENDPOINT, $error, $message, 50000, STREAM_CLIENT_CONNECT, $context);

        if (!$fp || $error) {
            if ($this->isDebug()) {
                throw new PushException(strtr('Could not connect to APN SERVER, error #:error: :message', [
                    ':error'   => $error,
                    ':message' => $message,
                ]));
            } else {
                return false;
            }
        }

        return $fp;
    }

    /**
     * @return string
     */
    public function getCertificate()
    {
        return $this->certificate;
    }

    /**
     * @param string $certificate
     */
    public function setCertificate($certificate)
    {
        $this->certificate = $certificate;
    }

    /**
     * @return string
     */
    public function getPassPhrase()
    {
        return $this->passPhrase;
    }

    /**
     * @param string $passPhrase
     */
    public function setPassPhrase($passPhrase)
    {
        $this->passPhrase = $passPhrase;
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

    /**
     * @param PushMessage $message
     *
     * @return string
     */
    private function prepareMessageToSend(PushMessage $message)
    {
        return $message->__toString();
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


}