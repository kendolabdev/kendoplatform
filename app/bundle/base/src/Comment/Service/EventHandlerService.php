<?php
namespace Comment\Service;

use Comment\Model\Comment;
use Picaso\Application\EventHandler;
use Picaso\Assets\Requirejs;
use Picaso\Content\CanComment;
use Picaso\Hook\HookEvent;
use Picaso\Hook\SimpleContainer;

/**
 * Class EventHandlerService
 *
 * @package Comment\Service
 */
class EventHandlerService extends EventHandler {
    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleStylesheet(HookEvent $event) {
        $payload = $event->getPayload();

        if (!$payload instanceof SimpleContainer) return;

        $payload->add('base/comment', 'base/comment');
    }

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event) {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/comment/main'])
            ->addPrimaryBundle('base/comment/main');
    }

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event) {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/comment/main']);
    }

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onAfterInsertComment(HookEvent $event) {
        $cmt = $event->getPayload();

        if (!$cmt instanceof Comment) return;

        $about = $cmt->getAbout();

        if (!$about instanceof CanComment) return;

        $about->modify('comment_count', 'comment_count+1');

        /**
         * check to notify any subscribed members about this post
         */

        \App::notificationService()
            ->notify('item_commented', $cmt->getPoster(), $about, ['id' => $cmt->getId()]);

    }

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onAfterDeleteComment(HookEvent $event) {
        $cmt = $event->getPayload();

        if (!$cmt instanceof Comment) return;

        $about = $cmt->getAbout();

        if ($about instanceof CanComment)
            $about->modify('comment_count', 'comment_count-1');

    }
}