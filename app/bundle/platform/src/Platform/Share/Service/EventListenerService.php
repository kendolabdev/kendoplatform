<?php
namespace Platform\Share\Service;

use Kendo\Hook\EventListener;
use Kendo\Assets\Requirejs;
use Kendo\Content\AtomInterface;
use Kendo\Content\PosterInterface;
use Kendo\Hook\HookEvent;
use Kendo\Hook\SimpleContainer;
use Kendo\Routing\RoutingManager;
use Kendo\View\ViewHelper;
use Platform\Share\Model\Share;

/**
 * Class EventHandlerService
 *
 * @package Share\Service
 */
class EventListenerService extends EventListener
{

    /**
     * @param HookEvent $event
     */
    public function onViewHelperStart(HookEvent $event)
    {
        $helper = $event->getPayload();

        if (!$helper instanceof ViewHelper) return;

        $helper->addClassMaps([
            'lnShare'         => '\Platform\Share\ViewHelper\LinkShare',
            'listShareSample' => '\Platform\Share\ViewHelper\ListShareSample',
        ]);
    }

    /**
     * @param HookEvent $event
     */
    public function onRoutingStart(HookEvent $event)
    {
        $routing = $event->getPayload();

        if (!$routing instanceof RoutingManager) return;
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleStylesheet(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof SimpleContainer) return;

        $payload->add('platform/share', 'platform/share/main');
    }

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/share/main'])
            ->addPrimaryBundle('platform/share/main');
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/share/main']);
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


        app()->notificationService()->notify('item_shared', $poster, $share);

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