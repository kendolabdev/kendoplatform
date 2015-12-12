<?php
namespace Platform\Relation;

use Kendo\Routing\FilterStuff;

/**
 * Class Module
 *
 * @package Platform\Relation
 */
class Module extends \Kendo\Application\Module
{
    /**
     *
     */
    public function start()
    {

        \App::htmlService()->addPlugin('privacyButton', '\Relation\Html\PrivacyButtonField');


    }

}