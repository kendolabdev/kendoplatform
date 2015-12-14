<?php

namespace Platform\Like\Service;

use Kendo\Routing\FilterStuff;
use Kendo\Routing\RoutingManager;
use Kendo\View\ViewHelper;
use Platform\Like\Model\Like;
use Kendo\Hook\EventListener;
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
            'lnLike'         => '\Like\ViewHelper\LinkLike',
            'lnLikeComment'  => '\Like\ViewHelper\LinkLikeComment',
            'listLikeSample' => '\Like\ViewHelper\ListLikeSample',
        ]);
    }

    /**
     * @param HookEvent $event
     */
    public function onRoutingStart(HookEvent $event)
    {
        $routing = $event->getPayload();

        if (!$routing instanceof RoutingManager) return;

        $routing->getRoute('profile')
            ->addFilter(new FilterStuff([
                'stuff'      => 'likes',
                'controller' => '\Like\Controller\ProfileController',
                'action'     => 'browse-like']));
    }

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/like/main'])
            ->addPrimaryBundle('platform/like/main');
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/like/main']);
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