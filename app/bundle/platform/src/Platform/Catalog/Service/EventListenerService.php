<?php
namespace Platform\Catalog\Service;

use Kendo\Event\EventListener;
use Kendo\Content\CatalogInterface;
use Kendo\Event\HookEvent;
use Kendo\Routing\RoutingManager;

/**
 * Class EventHandlerService
 *
 * @package Attribute\Service
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
    public function onCompleteCreatePoster(HookEvent $event)
    {


        $item = $event->getPayload('poster');


        $data = $event->getPayload('data', []);


        if (!$item instanceof CatalogInterface) return;

        \App::catalogService()
            ->updateItemAttribute($item, $data);
    }
}