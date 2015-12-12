<?php
namespace Platform\Share\Service;

use Kendo\Application\EventHandler;
use Kendo\Assets\Requirejs;
use Kendo\Content\AtomInterface;
use Kendo\Content\PosterInterface;
use Kendo\Hook\HookEvent;
use Kendo\Hook\SimpleContainer;
use Platform\Share\Model\Share;

/**
 * Class EventHandlerService
 *
 * @package Share\Service
 */
class EventHandlerService extends EventHandler
{

    /**
     * @param \Kendo\Hook\HookEvent $event
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
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/share/main']);
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onAfterInsertShare(HookEvent $event)
    {
        $share = $event->getPayload();

        if (!$share instanceof Share) return;

        $about = $share->getAbout();
        $poster = $share->getPoster();

        if (!$poster instanceof PosterInterface) return;

        if ($about instanceof AtomInterface)
            $about->modify('share_count', 'share_count+1');


        \App::notificationService()->notify('item_shared', $poster, $share);

    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onAfterDeleteShare(HookEvent $event)
    {
        $share = $event->getPayload();

        if (!$share instanceof Share) return;

        $about = $share->getAbout();

        if ($about instanceof AtomInterface)
            $about->modify('share_count', 'share_count-1');

    }
}