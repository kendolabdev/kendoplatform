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

        \App::html()->addPlugin('privacyButton', '\Relation\Html\PrivacyButtonField');

        \App::viewHelper()->addClassMaps([
            'labelPrivacy' => '\Relation\ViewHelper\LabelPrivacy'
        ]);

        $routing = \App::routing();

        $routing->getRoute('profile')
            ->addFilter(new FilterStuff([
                'stuff'  => 'members',
                'action' => 'browse-member',]));
    }

}