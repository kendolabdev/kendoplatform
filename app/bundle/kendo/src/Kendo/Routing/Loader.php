<?php

namespace Kendo\Routing;

/**
 * Class Loader
 *
 * @package Kendo\Routing
 */
class Loader implements LoaderInterface
{

    function load()
    {
        return
            include SEQUEL_SETTING_PATH . '/route.php';
    }

}
