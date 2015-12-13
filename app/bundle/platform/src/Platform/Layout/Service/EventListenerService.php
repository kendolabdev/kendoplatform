<?php
namespace Platform\Layout\Service;

use Kendo\Event\EventListener;
use Kendo\Assets\Requirejs;
use Kendo\Event\HookEvent;
use Kendo\Routing\RoutingManager;

/**
 * Class EventHandlerService
 *
 * @package Platform\Layout\Service
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

        $routing->addRoute('layout_theme', [
            'uri'      => 'layout/select-theme',
            'defaults' => [
                'controller' => '\Layout\Controller\HomeController',
                'action'     => 'select-theme',
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

        $requirejs->addDependency(['platform/layout/main'])
            ->addPrimaryBundle('platform/layout/main');
    }

    /**
     * @param \Kendo\Event\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/layout/main']);
    }
}