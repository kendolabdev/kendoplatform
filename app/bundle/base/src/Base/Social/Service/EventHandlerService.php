<?php
namespace Base\Social\Service;

use Kendo\Application\EventHandler;
use Kendo\Assets\Requirejs;
use Kendo\Hook\HookEvent;
use Kendo\Hook\SimpleContainer;

/**
 * Class EventHandlerService
 *
 * @package Social\Service
 */
class EventHandlerService extends EventHandler
{

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event) {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/social/main'])
            ->addPrimaryBundle('base/social/main');
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/social/main']);

    }
}