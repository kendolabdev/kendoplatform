<?php

namespace Kendo\Request;

/**
 * Interface Result
 *
 * @package Kendo\Request
 */
interface Result
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