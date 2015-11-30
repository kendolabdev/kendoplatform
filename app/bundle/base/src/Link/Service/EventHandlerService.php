<?php
namespace Link\Service;

use Picaso\Application\EventHandler;
use Picaso\Assets\Requirejs;
use Picaso\Hook\HookEvent;
use Picaso\Hook\SimpleContainer;

/**
 * Class EventHandlerService
 *
 * @package Link\Service
 */
class EventHandlerService extends EventHandler {
    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleStylesheet(HookEvent $event) {
        $payload = $event->getPayload();

        if (!$payload instanceof SimpleContainer)
            return;

        $payload->add('base/link', 'base/link');
    }

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event) {
        $payload = $event->getPayload();

        if (!$payload instanceof Requirejs)
            return;

        $payload->addDependency(['base/link/main']);
    }
}