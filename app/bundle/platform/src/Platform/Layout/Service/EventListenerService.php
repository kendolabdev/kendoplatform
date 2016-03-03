<?php
namespace Platform\Layout\Service;

use Kendo\Hook\EventListener;
use Kendo\Assets\Requirejs;
use Kendo\Hook\HookEvent;
use Kendo\Http\RoutingManager;

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

        $routing->add( [
            'name'=>'layout_theme',
            'uri'      => 'layout/select-theme',
            'defaults' => [
                'controller' => 'Platform\Layout\Controller\HomeController',
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
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/layout/main']);
    }
}