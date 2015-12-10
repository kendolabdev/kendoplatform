<?php
namespace Platform\Notification;

use Kendo\Routing\FilterStuff;

/**
 * Class Module
 *
 * @package Platform\Notification
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
                'stuff'      => 'notifications',
                'controller' => '\Notification\Controller\ProfileController',
                'action'     => 'browse-notification']));

        \App::routingService()->addRoute('notifications', [
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