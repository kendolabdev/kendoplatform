<?php
namespace Attribute\Service;

use Picaso\Application\EventHandler;
use Picaso\Content\HasAttribute;
use Picaso\Hook\HookEvent;

/**
 * Class EventHandlerService
 *
 * @package Attribute\Service
 */
class EventHandlerService extends EventHandler
{
    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onCompleteCreatePoster(HookEvent $event)
    {


        $item = $event->get('poster');


        $data = $event->get('data', []);



        if (!$item instanceof HasAttribute) return;

        \App::attribute()
            ->updateItemAttribute($item, $data);
    }
}