<?php
namespace Platform\Comment\Service;

use Kendo\Http\RoutingManager;
use Kendo\View\ViewHelper;
use Platform\Comment\Model\Comment;
use Kendo\Hook\EventListener;
use Kendo\Assets\Requirejs;
use Kendo\Content\AtomInterface;
use Kendo\Hook\HookEvent;
use Kendo\Hook\SimpleContainer;

/**
 * Class EventHandlerService
 *
 * @package Base\Comment\Service
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
            'lnComment'         => '\Platform\Comment\ViewHelper\LinkComment',
            'lnViewMoreComment' => '\Platform\Comment\ViewHelper\LinkViewMoreComment',
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

        $payload->add('platform/comment', 'platform/comment/main');
    }

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/comment/main'])
            ->addPrimaryBundle('platform/comment/main');
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/comment/main']);
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onAfterInsertComment(HookEvent $event)
    {
        $cmt = $event->getPayload();

        if (!$cmt instanceof Comment) return;

        $about = $cmt->getAbout();

        if (!$about instanceof AtomInterface) return;

        $about->modify('comment_count', 'comment_count+1');

        /**
         * check to notify any subscribed members about this post
         */

        \App::notificationService()
            ->notify('item_commented', $cmt->getPoster(), $about, ['id' => $cmt->getId()]);

    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onAfterDeleteComment(HookEvent $event)
    {
        $cmt = $event->getPayload();

        if (!$cmt instanceof Comment) return;

        $about = $cmt->getAbout();

        if ($about instanceof AtomInterface)
            $about->modify('comment_count', 'comment_count-1');

    }
}