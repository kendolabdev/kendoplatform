<?php
namespace Review\Service;

use Picaso\Application\EventHandler;
use Picaso\Assets\Requirejs;
use Picaso\Hook\HookEvent;
use Picaso\Hook\SimpleContainer;

/**
 * Class EventHandlerService
 *
 * @package Review\Service
 */
class EventHandlerService extends EventHandler
{
    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof Requirejs) return;

        $payload->addDependency(['base/review/main']);
    }
}