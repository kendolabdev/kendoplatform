<?php
namespace Attribute\Service;

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


        $item = $event->get('poster');


        $data = $event->get('data', []);



        if (!$item instanceof CatalogInterface) return;

        \App::catalogService()
            ->updateItemAttribute($item, $data);
    }
}