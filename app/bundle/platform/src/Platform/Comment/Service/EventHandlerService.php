<?php
namespace Platform\Comment\Service;

use Platform\Comment\Model\Comment;
use Kendo\Application\EventHandler;
use Kendo\Assets\Requirejs;
use Kendo\Content\AtomInterface;
use Kendo\Hook\HookEvent;
use Kendo\Hook\SimpleContainer;

/**
 * Class EventHandlerService
 *
 * @package Base\Comment\Service
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

        $payload->add('base/comment', 'base/comment/main');
    }

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/comment/main'])
            ->addPrimaryBundle('base/comment/main');
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/comment/main']);
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