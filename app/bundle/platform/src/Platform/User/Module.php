<?php

namespace Platform\User;

use Kendo\Routing\FilterProfileSlug;
use Kendo\Routing\FilterStuff;


/**
 * Class Module
 *
 * @package Platform\User
 */
class Module extends \Kendo\Application\Module
{

    /**
     * @return bool
     */
    public function start()
    {
        \App::authService()->restore();


    }

    /**
     * @return bool
     */
    public function complete()
    {
        // TODO: Implement bootComplete() method.


    }
}