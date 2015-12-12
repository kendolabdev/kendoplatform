<?php
namespace Platform\Link\Service;

use Kendo\Application\EventHandler;
use Kendo\Assets\Requirejs;
use Kendo\Hook\HookEvent;
use Kendo\Hook\SimpleContainer;

/**
 * Class EventHandlerService
 *
 * @package Base\Link\Service
 */
class EventHandlerService extends EventHandler {
    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleStylesheet(HookEvent $event) {
        $payload = $event->getPayload();

        if (!$payload instanceof SimpleContainer)
            return;

        $payload->add('base/link', 'base/link/main');
    }

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event) {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/link/main'])
            ->addPrimaryBundle('base/link/main');
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event) {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs)
            return;

        $requirejs->addDependency(['base/link/main']);
    }
}