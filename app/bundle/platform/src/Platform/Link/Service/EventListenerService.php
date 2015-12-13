<?php
namespace Platform\Link\Service;

use Kendo\Event\EventListener;
use Kendo\Assets\Requirejs;
use Kendo\Event\HookEvent;
use Kendo\Event\SimpleContainer;
use Kendo\Routing\RoutingManager;

/**
 * Class EventHandlerService
 *
 * @package Base\Link\Service
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
    }

    /**
     * @param \Kendo\Event\HookEvent $event
     */
    public function onBeforeBuildBundleStylesheet(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof SimpleContainer)
            return;

        $payload->add('platform/link', 'platform/link/main');
    }

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/link/main'])
            ->addPrimaryBundle('platform/link/main');
    }

    /**
     * @param \Kendo\Event\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs)
            return;

        $requirejs->addDependency(['platform/link/main']);
    }
}