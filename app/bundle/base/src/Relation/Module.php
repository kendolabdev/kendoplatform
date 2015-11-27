<?php
namespace Relation;

use Picaso\Routing\FilterStuff;

/**
 * Class Module
 *
 * @package Relation
 */
class Module extends \Picaso\Application\Module
{
    /**
     *
     */
    public function start()
    {

        \App::htmlService()->addPlugin('privacyButton', '\Relation\Html\PrivacyButtonField');

        \App::viewHelper()->addClassMaps([
            'labelPrivacy' => '\Relation\ViewHelper\LabelPrivacy'
        ]);

        $routing = \App::routingService();

        $routing->getRoute('profile')
            ->addFilter(new FilterStuff([
                'stuff'  => 'members',
                'action' => 'browse-member',]));
    }

}