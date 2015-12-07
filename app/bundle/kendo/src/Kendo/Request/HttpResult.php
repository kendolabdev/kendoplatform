<?php

namespace Kendo\Request;

/**
 * Class HttpResult
 *
 * @package Kendo\Request
 */
class HttpResult implements Result
{

    /**
     * @var string
     */
    protected $data = '';

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $value
     */
    public function setData($value)
    {
        $this->data = $value;
    }

    /**
     * Reset data
     */
    public function reset()
    {
        $this->data = '';
    }
}