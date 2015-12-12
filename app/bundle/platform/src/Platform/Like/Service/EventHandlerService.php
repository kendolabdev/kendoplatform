<?php

namespace Platform\Like\Service;

use Platform\Like\Model\Like;
use Kendo\Application\EventHandler;
use Kendo\Assets\Requirejs;
use Kendo\Content\AtomInterface;
use Kendo\Content\PosterInterface;
use Kendo\Hook\HookEvent;
use Platform\User\Model\User;

/**
 * Class EventHandlerService
 *
 * @package Like\Service
 */
class EventHandlerService extends EventHandler
{

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/like/main'])
            ->addPrimaryBundle('base/like/main');
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/like/main']);
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

        if (!$profile instanceof PosterInterface)
            return false;

        if (!$profile->authorize('activity__like_tab_exists'))
            return false;

        if (!\App::aclService()->pass($profile, 'activity__like_tab_view'))
            return false;

        $item['href'] = $profile->toHref(['stuff' => 'likes']);

        return $item;
    }


    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onAfterInsertLike(HookEvent $event)
    {
        $like = $event->getPayload();

        if (!$like instanceof Like) return;

        $about = $like->getAbout();

        if ($about instanceof AtomInterface)
            $about->modify('like_count', 'like_count+1');

        \App::notificationService()->notify('item_liked', $like->getPoster(), $about);

    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onAfterDeleteLike(HookEvent $event)
    {
        $like = $event->getPayload();

        if (!$like instanceof Like) return;

        $about = $like->getAbout();

        if ($about instanceof AtomInterface)
            $about->modify('like_count', 'like_count-1');

    }
}