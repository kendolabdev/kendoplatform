<?php

namespace Kendo\Hook;

/**
 * Class HookEvent
 *
 * @package Kendo\Hook
 */
class HookEvent
{
    /**
     * @var
     */
    public $payload;

    /**
     * @var array
     */
    public $response = [];

    /**
     * @param mixed $payload
     */
    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    /**
     * @param       $key
     * @param mixed $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return isset($this->payload[ $key ]) ? $this->payload[ $key ] : $default;
    }

    /**
     * @param      $value
     * @param bool $prepend
     */
    public function addResponse($value, $prepend = false)
    {
        if ($prepend) {
            array_unshift($this->response, $value);
        } else {
            $this->response[] = $value;
        }

    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param $value
     */
    public function setResponse($value)
    {
        $this->response = [$value];
    }

    /**
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @return string
     */
    public function getResponseHtml()
    {
        return implode('', $this->response);
    }
}