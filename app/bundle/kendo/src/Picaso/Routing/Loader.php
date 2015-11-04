<?php

namespace Picaso\Routing;

/**
 * Class Loader
 *
 * @package Picaso\Routing
 */
class Loader implements LoaderInterface
{

    function load()
    {
        return
            include SEQUEL_SETTING_PATH . '/route.php';
    }

}
