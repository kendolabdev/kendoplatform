<?php

namespace Message\Service;

use Picaso\Application\EventHandler;
use Picaso\Assets\Requirejs;
use Picaso\Hook\HookEvent;
use Picaso\Hook\SimpleContainer;

/**
 * Class EventHandlerService
 *
 * @package Message\Service
 */
class EventHandlerService extends EventHandler
{

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleStylesheet(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof SimpleContainer) return;

        $payload->add('base/message', 'base/message');
    }

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof Requirejs) return;

        $payload->addDependency(['base/message/main']);
    }


    /**
     * @param $item
     *
     * @return bool
     */
    public function onMenuMainMessages($item)
    {
        if (!\App::authService()->logged())
            return false;

        $item['class'] = 'visible-xs ni-message';

        return $item;
    }
}