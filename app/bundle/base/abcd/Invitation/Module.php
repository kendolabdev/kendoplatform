<?php
namespace Invitation;

use Kendo\Routing\FilterStuff;

/**
 * Class Module
 *
 * @package Invitation
 */
class Module extends \Kendo\Application\Module
{
    /**
     * @return bool
     */
    public function start()
    {
        \App::routingService()->getRoute('profile')
            ->addFilter(new FilterStuff([
                'stuff'      => 'requests',
                'controller' => '\Invitation\Controller\ProfileController',
                'action'     => 'browse-invitation']));

        \App::routingService()->addRoute('requests', [
            'uri'      => 'requests',
            'defaults' => [
                'controller' => '\Invitation\Controller\HomeController',
                'action'     => 'browse-invitation',
            ],
        ]);

        \App::viewHelper()
            ->addClassMaps([
                'btnBearInvitation' => '\Invitation\ViewHelper\ButtonBearInvitation',
            ]);
    }
}