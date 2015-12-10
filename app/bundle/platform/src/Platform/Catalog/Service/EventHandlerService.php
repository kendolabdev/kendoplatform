<?php
namespace Platform\Catalog\Service;

use Kendo\Application\EventHandler;
use Kendo\Content\CatalogInterface;
use Kendo\Hook\HookEvent;

/**
 * Class EventHandlerService
 *
 * @package Attribute\Service
 */
class EventHandlerService extends EventHandler
{
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