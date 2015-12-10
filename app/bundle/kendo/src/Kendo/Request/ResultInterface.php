<?php

namespace Kendo\Request;

/**
 * Interface Result
 *
 * @package Kendo\Request
 */
interface ResultInterface
{

    /**
     * @param $value
     */
    public function setData($value);

    /**
     * @return mixed
     */
    public function getData();

    /**
     * Reset data
     */
    public function reset();

}