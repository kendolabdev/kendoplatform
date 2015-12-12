<?php
namespace Platform\Phrase\Service;

use Kendo\Application\EventHandler;
use Kendo\Hook\HookEvent;
use Kendo\Routing\RoutingManager;

/**
 * Class EventHandlerService
 *
 * @package Platform\Phrase\Service
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