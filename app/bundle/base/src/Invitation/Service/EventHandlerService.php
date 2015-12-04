<?php
namespace Invitation\Service;

use Picaso\Application\EventHandler;
use Picaso\Assets\Requirejs;
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
    public function onBeforeBuildBundleStylesheet(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof SimpleContainer) return;

        $payload->add('base/invitation', 'base/invitation/main');
    }

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event) {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/invitation/main'])
            ->addPrimaryBundle('base/invitation/main');
    }

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/invitation/main']);
    }

    /**
     * @param $item
     *
     * @return bool
     */
    public function onProfileMenuItemRequests($item)
    {
        $profile = \App::registryService()->get('profile');

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
        if (!\App::authService()->logged())
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

        \App::notificationService()->addAcceptMembershipNotification($parent, $poster);

        \App::invitationService()
            ->removeMembershipRequest($poster, $parent);

        if ($parent instanceof User)
            \App::invitationService()
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

        \App::invitationService()
            ->addMembershipRequest($poster, $parent);
    }
}