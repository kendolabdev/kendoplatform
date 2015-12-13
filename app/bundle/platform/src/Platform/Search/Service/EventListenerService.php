<?php
namespace Platform\Search\Service;

use Kendo\Event\EventListener;
use Kendo\Assets\Requirejs;
use Kendo\Event\HookEvent;
use Kendo\Event\SimpleContainer;
use Kendo\Routing\RoutingManager;

/**
 * Class EventHandlerService
 *
 * @package Platform\Search\Service
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

        $routing->addRoute('search', [
            'uri'      => 'search',
            'defaults' => [
                'controller' => 'Search\Controller\HomeController',
                'action'     => 'browse',
            ],
        ]);
    }

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/search/main'])
            ->addPrimaryBundle('platform/search/main');
    }

    /**
     * @param \Kendo\Event\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/search/main']);
    }
}