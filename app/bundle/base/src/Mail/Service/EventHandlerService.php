<?php
namespace Mail\Service;

use Picaso\Application\EventHandler;
use Picaso\Assets\Requirejs;
use Picaso\Hook\HookEvent;
use Picaso\Hook\SimpleContainer;

/**
 * Class EventHandlerService
 *
 * @package Mail\Service
 */
class EventHandlerService extends EventHandler
{
    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event) {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/mail/main'])
            ->addPrimaryBundle('base/mail/main');
    }

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/mail/main']);
    }
}