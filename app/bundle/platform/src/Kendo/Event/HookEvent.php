<?php

namespace Kendo\Event;

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
     * @param $payload
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
    }

    /**
     * @param mixed $value
     */
    public function append($value)
    {
        $this->response[] = $value;
    }

    /**
     * @param mixed $value
     */
    public function prepend($value)
    {
        array_unshift($this->response, $value);
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
     * @param string|null $name
     * @param string|null $defaultValue
     *
     * @return mixed
     */
    public function getPayload($name = null, $defaultValue = null)
    {
        if (null != $name) {
            return isset($this->payload[ $name ]) ? $this->payload[ $name ] : $defaultValue;
        }

        return $this->payload;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return implode('', $this->response);
    }
}