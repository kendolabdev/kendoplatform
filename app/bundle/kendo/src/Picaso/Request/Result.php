<?php

namespace Picaso\Request;

/**
 * Interface Result
 *
 * @package Picaso\Request
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