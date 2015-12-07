<?php

namespace Kendo\Routing;

/**
 * Interface FilterInterface
 *
 * @package Kendo\Routing
 */
interface FilterInterface
{

    /**
     * @param array $params
     */
    public function __construct($params);

    /**
     * @param array $params
     *
     * @return bool|array
     */
    public function filter($params);

    /**
     * @return boolean
     */
    public function isChain();

    /**
     * @return bool
     */
    public function stopOnFail();
}