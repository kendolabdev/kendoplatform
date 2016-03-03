<?php
namespace Platform\Navigation\Service;

use Kendo\Hook\EventListener;
use Kendo\Hook\HookEvent;
use Kendo\Http\RoutingManager;

/**
 * Class EventHandlerService
 *
 * @package Platform\Navigation\Service
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
}