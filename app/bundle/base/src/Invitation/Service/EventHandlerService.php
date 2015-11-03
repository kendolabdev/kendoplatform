<?php
namespace Invitation\Service;

use Picaso\Application\EventHandler;
use Picaso\Content\Poster;
use Picaso\Hook\HookEvent;
use Picaso\Hook\SimpleContainer;
use User\Model\User;

/**
 * Class EventHandlerService
 *
 * @package Invitation\Service
 */
class EventHandlerService extends EventHandler
{

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof SimpleContainer) return;

        $payload->add('invitation/main', 'base/invitation/main');
    }

    /**
     * @param $item
     *
     * @return bool
     */
    public function onProfileMenuItemRequests($item)
    {
        $profile = \App::registry()->get('profile');

        if (!$profile instanceof Poster) return false;

        if (!$profile->viewerIsParent()) return false;

        $item['href'] = $profile->toHref(['stuff' => 'requests']);

        return $item;
    }

    /**
     * @param $item
     *
     * @return bool
     */
    public function onMenuMainInvitations($item)
    {
        if (!\App::auth()->logged())
            return false;

        $item['class'] = 'visible-xs ni-invitation';

        return $item;
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

        \App::invitation()
            ->removeMembershipRequest($poster, $parent);

        if ($parent instanceof User)
            \App::invitation()
                ->removeMembershipRequest($parent, $poster);
    }

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onAfterInsertMembershipRequest(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof MembershipRequest) return;

        $poster = $payload->getPoster();
        $parent = $payload->getParent();

        if (!$poster instanceof Poster or !$parent instanceof Poster) return;

        \App::invitation()
            ->addMembershipRequest($poster, $parent);
    }
}