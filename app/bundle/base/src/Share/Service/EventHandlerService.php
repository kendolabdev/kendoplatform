<?php
namespace Share\Service;

use Picaso\Application\EventHandler;
use Picaso\Assets\Requirejs;
use Picaso\Content\CanShare;
use Picaso\Content\Poster;
use Picaso\Hook\HookEvent;
use Picaso\Hook\SimpleContainer;
use Share\Model\Share;

/**
 * Class EventHandlerService
 *
 * @package Share\Service
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

        $payload->add('base/share', 'base/share/main');
    }

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event) {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/share/main'])
            ->addPrimaryBundle('base/share/main');
    }

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/share/main']);
    }

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onAfterInsertShare(HookEvent $event)
    {
        $share = $event->getPayload();

        if (!$share instanceof Share) return;

        $about = $share->getAbout();
        $poster = $share->getPoster();

        if (!$poster instanceof Poster) return;

        if ($about instanceof CanShare)
            $about->modify('share_count', 'share_count+1');


        \App::notificationService()->notify('item_shared', $poster, $share);

    }

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onAfterDeleteShare(HookEvent $event)
    {
        $share = $event->getPayload();

        if (!$share instanceof Share) return;

        $about = $share->getAbout();

        if ($about instanceof CanShare)
            $about->modify('share_count', 'share_count-1');

    }
}