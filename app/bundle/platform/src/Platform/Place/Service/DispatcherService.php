<?php
namespace Platform\Place\Service;

use Kendo\Application\EventHandler;
use Kendo\Hook\HookEvent;
use Kendo\Routing\RoutingManager;

/**
 * Class EventHandlerService
 *
 * @package Place\Service
 */
class DispatcherService extends EventHandler
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