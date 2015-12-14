<?php
namespace Platform\Payment\Service;

use Kendo\Hook\EventListener;
use Kendo\Hook\HookEvent;
use Kendo\Routing\RoutingManager;

/**
 * Class EventHandlerService
 *
 * @package Platform\Payment\Service
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