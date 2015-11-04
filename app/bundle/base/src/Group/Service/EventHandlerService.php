<?php

namespace Group\Service;

use Invitation\Model\Invitation;
use Picaso\Application\EventHandler;
use Picaso\Hook\HookEvent;
use Picaso\Hook\SimpleContainer;
use Picaso\View\View;
use User\Model\User;

/**
 * Class EventHandlerService
 *
 * @package Group\Service
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

        $payload->add('base/group', 'base/group');
    }

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof SimpleContainer) return;

        $payload->add('group/main', 'base/group/main');
    }

    /**
     * @param Invitation $invitation
     */
    public function onAcceptRequestMembershipGroup(Invitation $invitation)
    {
        /**
         * current viewer called to accept data
         */
        $poster = $invitation->getPoster();

        $parent = $invitation->getParent();

        \App::relation()->acceptMembershipRequest($poster, $parent, false);
    }

    /**
     * @param $item
     *
     * @return mixed
     */
    public function onProfileMenuItemGroups($item)
    {
        $profile = \App::registry()->get('profile');


        if (!$profile instanceof User)
            return false;

        if (!$profile->authorize('group__group_tab_exists'))
            return false;

        if (!\App::acl()->pass($profile, 'group__group_tab_view'))
            return false;

        $item['href'] = $profile->toHref(['stuff' => 'groups']);

        return $item;
    }


    /**
     * @param HookEvent $event
     */
    public function onAdminStatisticBlockRender(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof View) return;

        $stats = $payload->__get('stats');

        $stats['group'] = [
            'label' => \App::text('group.groups'),
            'value' => \App::service('group')->getAdminStatisticCount(),
        ];

        $payload->__set('stats', $stats);
    }
}