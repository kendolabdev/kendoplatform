<?php
namespace Platform\Social\Service;

use Kendo\Event\EventListener;
use Kendo\Assets\Requirejs;
use Kendo\Event\HookEvent;
use Kendo\Event\SimpleContainer;
use Kendo\Routing\RoutingManager;

/**
 * Class EventHandlerService
 *
 * @package Social\Service
 */
class EventListenerService extends EventListener
{

    /**
     * @param HookEvent $event
     */
    public function onRoutingStart(HookEvent $event)
    {
        $routing = $event->getPayload();

        if (!$routing instanceof RoutingManager) return;

        $routing->addRoute('connect', [
            'uri'      => 'connect/<service>',
            'defaults' => [
                'controller' => 'Social\Controller\ConnectController',
                'action'     => 'connect',
            ]
        ]);

        $routing->addRoute('oauth_callback', [
            'uri'      => 'oauth-callback/<service>',
            'defaults' => [
                'controller' => 'Social\Controller\ConnectController',
                'action'     => 'callback',
            ]
        ]);

        $routing->addRoute('oauth_success', [
            'uri'      => 'oauth-success/<service>',
            'defaults' => [
                'controller' => 'Social\Controller\ConnectController',
                'action'     => 'success',
            ]
        ]);

        $routing->addRoute('oauth_failure', [
            'uri'      => 'oauth_failure/<service>',
            'defaults' => [
                'controller' => 'Social\Controller\ConnectController',
                'action'     => 'failure',
            ]
        ]);
    }

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/social/main'])
            ->addPrimaryBundle('platform/social/main');
    }

    /**
     * @param \Kendo\Event\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/social/main']);

    }
}