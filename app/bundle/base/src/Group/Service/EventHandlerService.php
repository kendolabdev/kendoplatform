<?php

namespace Group\Service;

use Invitation\Model\Invitation;
use Picaso\Application\EventHandler;
use Picaso\Assets\Requirejs;
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
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event) {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/group/main'])
            ->addPrimaryBundle('base/group/main');
    }

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/group/main']);
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

        \App::relationService()->acceptMembershipRequest($poster, $parent, false);
    }

    /**
     * @param $item
     *
     * @return mixed
     */
    public function onProfileMenuItemGroups($item)
    {
        $profile = \App::registryService()->get('profile');


        if (!$profile instanceof User)
            return false;

        if (!$profile->authorize('group__group_tab_exists'))
            return false;

        if (!\App::aclService()->pass($profile, 'group__group_tab_view'))
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
            'value' => \App::groupService()->getAdminStatisticCount(),
        ];

        $payload->__set('stats', $stats);
    }
}