<?php
namespace Notification;

use Picaso\Routing\FilterStuff;

/**
 * Class Module
 *
 * @package Notification
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
                'stuff'      => 'notifications',
                'controller' => '\Notification\Controller\ProfileController',
                'action'     => 'browse-notification']));

        \App::routing()->addRoute('notifications', [
            'uri'      => 'notifications',
            'defaults' => [
                'controller' => '\Notification\Controller\HomeController',
                'action'     => 'browse-notification',
            ],
        ]);

        \App::viewHelper()
            ->addClassMaps([
                'btnBearNotification' => '\Notification\ViewHelper\ButtonBearNotification',
            ]);
    }

}