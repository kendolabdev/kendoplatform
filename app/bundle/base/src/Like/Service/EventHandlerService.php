<?php

namespace Like\Service;

use Like\Model\Like;
use Picaso\Application\EventHandler;
use Picaso\Assets\Requirejs;
use Picaso\Content\CanLike;
use Picaso\Content\Poster;
use Picaso\Hook\HookEvent;
use Picaso\Hook\SimpleContainer;
use User\Model\User;

/**
 * Class EventHandlerService
 *
 * @package Like\Service
 */
class EventHandlerService extends EventHandler
{

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof Requirejs) return;

        $payload->addDependency(['base/like/main']);
    }

    /**
     * @param $item
     *
     * @return array
     */
    public function onProfileMenuItemLikes($item)
    {
        $profile = \App::registryService()->get('profile');

        if ($profile instanceof User)
            return false;

        if (!$profile instanceof Poster)
            return false;

        if (!$profile->authorize('activity__like_tab_exists'))
            return false;

        if (!\App::aclService()->pass($profile, 'activity__like_tab_view'))
            return false;

        $item['href'] = $profile->toHref(['stuff' => 'likes']);

        return $item;
    }


    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onAfterInsertLike(HookEvent $event)
    {
        $like = $event->getPayload();

        if (!$like instanceof Like) return;

        $about = $like->getAbout();

        if ($about instanceof CanLike)
            $about->modify('like_count', 'like_count+1');

        \App::notificationService()->notify('item_liked', $like->getPoster(), $about);

    }

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onAfterDeleteLike(HookEvent $event)
    {
        $like = $event->getPayload();

        if (!$like instanceof Like) return;

        $about = $like->getAbout();

        if ($about instanceof CanLike)
            $about->modify('like_count', 'like_count-1');

    }
}