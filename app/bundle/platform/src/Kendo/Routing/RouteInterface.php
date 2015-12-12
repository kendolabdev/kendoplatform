<?php

namespace Kendo\Routing;

/**
 * Interface RouteInterface
 *
 * @package Sequel\Routing
 */
interface RouteInterface
{

    /**
     * @param  $uri
     *
     * @return bool
     */
    function match($uri);

    /**
     * @param array $params
     *
     * @return string
     */
    function getUrl($params = []);
}
