<?php
namespace Follow\Service;

use Follow\Model\Follow;
use Picaso\Application\EventHandler;
use Picaso\Assets\Requirejs;
use Picaso\Content\CanFollow;
use Picaso\Content\Poster;
use Picaso\Hook\HookEvent;
use User\Model\User;

/**
 * Class EventHandlerService
 *
 * @package Follow\Service
 */
class EventHandlerService extends EventHandler
{

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event) {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/follow/main'])
            ->addPrimaryBundle('base/follow/main');
    }

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/follow/main']);
    }

    /**
     * @param $item
     *
     * @return array
     */
    public function onProfileMenuItemFollowers($item)
    {
        $profile = \App::registryService()->get('profile');

        if (!$profile instanceof Poster)
            return false;

        if (!$profile->authorize('activity__follower_tab_exists'))
            return false;

        if (!\App::aclService()->pass($profile, 'activity__follower_tab_view'))
            return false;

        $item['href'] = $profile->toHref(['stuff' => 'followers']);

        return $item;
    }

    /**
     * @param $item
     *
     * @return array
     */
    public function onProfileMenuItemFollowing($item)
    {
        $profile = \App::registryService()->get('profile');

        if (!$profile instanceof Poster)
            return false;

        if (!$profile->authorize('activity__following_tab_exists'))
            return false;

        if (!\App::aclService()->pass($profile, 'activity__following_tab_view'))
            return false;

        if (!$profile->viewerIsParent())
            return false;

        $item['href'] = $profile->toHref(['stuff' => 'following']);

        return $item;
    }

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onAfterInsertFollow(HookEvent $event)
    {
        $follow = $event->getPayload();

        if (!$follow instanceof Follow) return;

        $parent = $follow->getParent();


        if ($parent instanceof CanFollow)
            $parent->modify('follow_count', 'follow_count+1');

        $poster = $follow->getPoster();

        if (!$poster instanceof Poster) return;

        \App::notificationService()->notify('item_followed', $poster, $poster);

    }

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onAfterDeleteFollow(HookEvent $event)
    {
        $follow = $event->getPayload();

        if (!$follow instanceof Follow) return;

        $parent = $follow->getParent();

        if ($parent instanceof CanFollow)
            $parent->modify('follow_count', 'follow_count-1');

    }

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onAcceptMembershipRequest(HookEvent $event)
    {
        $parent = $event->get('parent');
        $poster = $event->get('poster');

        if (!$parent instanceof Poster or !$poster instanceof Poster) return;

        \App::followService()->add($poster, $parent);

        /**
         * 2 ways friends for required.
         */
        if ($parent instanceof User && $poster instanceof User) {
            \App::followService()->add($parent, $poster);
        }
    }
}