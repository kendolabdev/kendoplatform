<?php

namespace Picaso\Routing;

/**
 * Interface FilterInterface
 *
 * @package Picaso\Routing
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