<?php
namespace Base\Follow\Service;

use Base\Follow\Model\Follow;
use Kendo\Application\EventHandler;
use Kendo\Assets\Requirejs;
use Kendo\Content\PosterInterface;
use Kendo\Hook\HookEvent;
use Platform\User\Model\User;

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
     * @param \Kendo\Hook\HookEvent $event
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

        if (!$profile instanceof PosterInterface)
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

        if (!$profile instanceof PosterInterface)
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
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onAfterInsertFollow(HookEvent $event)
    {
        $follow = $event->getPayload();

        if (!$follow instanceof Follow) return;

        $parent = $follow->getParent();


        if ($parent instanceof PosterInterface)
            $parent->modify('follow_count', 'follow_count+1');

        $poster = $follow->getPoster();

        if (!$poster instanceof PosterInterface) return;

        \App::notificationService()->notify('item_followed', $poster, $poster);

    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onAfterDeleteFollow(HookEvent $event)
    {
        $follow = $event->getPayload();

        if (!$follow instanceof Follow) return;

        $parent = $follow->getParent();

        if ($parent instanceof PosterInterface)
            $parent->modify('follow_count', 'follow_count-1');

    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onAcceptMembershipRequest(HookEvent $event)
    {
        $parent = $event->getPayload('parent');
        $poster = $event->getPayload('poster');

        if (!$parent instanceof PosterInterface or !$poster instanceof PosterInterface) return;

        \App::followService()->add($poster, $parent);

        /**
         * 2 ways friends for required.
         */
        if ($parent instanceof User && $poster instanceof User) {
            \App::followService()->add($parent, $poster);
        }
    }
}