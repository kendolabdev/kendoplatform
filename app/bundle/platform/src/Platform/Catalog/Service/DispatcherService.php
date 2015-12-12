<?php
namespace Platform\Catalog\Service;

use Kendo\Application\EventHandler;
use Kendo\Content\CatalogInterface;
use Kendo\Hook\HookEvent;
use Kendo\Routing\RoutingManager;

/**
 * Class EventHandlerService
 *
 * @package Attribute\Service
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

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onCompleteCreatePoster(HookEvent $event)
    {


        $item = $event->getPayload('poster');


        $data = $event->getPayload('data', []);


        if (!$item instanceof CatalogInterface) return;

        \App::catalogService()
            ->updateItemAttribute($item, $data);
    }
}