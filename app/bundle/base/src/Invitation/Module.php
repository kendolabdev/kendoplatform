<?php
namespace Invitation;

use Picaso\Routing\FilterStuff;

/**
 * Class Module
 *
 * @package Invitation
 */
class Module extends \Picaso\Application\Module
{
    /**
     * @return bool
     */
    public function start()
    {
        \App::routing()->getRoute('profile')
            ->addFilter(new FilterStuff([
                'stuff'      => 'requests',
                'controller' => '\Invitation\Controller\ProfileController',
                'action'     => 'browse-invitation']));

        \App::routing()->addRoute('requests', [
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