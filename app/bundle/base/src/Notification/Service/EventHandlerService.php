<?php
namespace Notification\Service;

use Picaso\Content\Content;
use Picaso\Content\Poster;
use Picaso\Hook\HookEvent;
use Picaso\Hook\SimpleContainer;

/**
 * Class EventHandlerService
 *
 * @package Notification\Service
 */
class EventHandlerService extends \Picaso\Application\EventHandler
{

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof SimpleContainer) return;

        $payload->add('notification/main', 'base/notification/main');
    }

    /**
     * @param $item
     *
     * @return bool
     */
    public function onMenuMainNotifications($item)
    {
        if (!\App::auth()->logged())
            return false;

        $item['class'] = 'visible-xs ni-notification';

        return $item;
    }

    /**
     * @param $item
     *
     * @return bool
     */
    public function onProfileMenuItemNotifications($item)
    {
        $profile = \App::registry()->get('profile');

        if (!$profile instanceof Poster) return false;

        if (!$profile->viewerIsParent()) return false;

        $item['href'] = $profile->toHref(['stuff' => 'notifications']);

        return $item;
    }


    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onAfterInsertContent(HookEvent $event)
    {
        $about = $event->getPayload();

        if (!$about instanceof Content) return;

        $poster = $about->getPoster();

        \App::notification()
            ->subscribe($poster, $about);
    }


    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onAfterDeleteContent(HookEvent $event)
    {
        $about = $event->getPayload();

        if (!$about instanceof Content) return;

        \App::notification()
            ->removeAllByAbout($about);
    }


    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onAfterInsertPoster(HookEvent $event)
    {
        /**
         * TODO: before insert poster get notification logic
         */
    }


    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onAfterDeletePoster(HookEvent $event)
    {
        $poster = $event->getPayload();

        if (!$poster instanceof Poster) return;

        \App::notification()
            ->removeAllByPoster($poster);
    }

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onAcceptMembershipRequest(HookEvent $event)
    {
        $parent = $event->get('parent');
        $poster = $event->get('poster');

        if (!$parent instanceof Poster or !$poster instanceof Poster) return;

        \App::notification()->addAcceptMembershipNotification($parent, $poster);

    }
}