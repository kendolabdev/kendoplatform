<?php

namespace Platform\Group\Service;

use Kendo\Routing\FilterStuff;
use Kendo\Routing\RoutingManager;
use Kendo\View\ViewHelper;
use Platform\Invitation\Model\Invitation;
use Kendo\Application\EventHandler;
use Kendo\Assets\Requirejs;
use Kendo\Hook\HookEvent;
use Kendo\Hook\SimpleContainer;
use Kendo\View\View;
use Platform\User\Model\User;

/**
 * Class EventHandlerService
 *
 * @package Group\Service
 */
class DispatcherService extends EventHandler
{
    /**
     * @param HookEvent $event
     */
    public function onViewHelperStart(HookEvent $event)
    {
        $helper = $event->getPayload();

        if (!$helper instanceof ViewHelper) return;

        $helper->addClassMaps([
            'btnGroupMembership' => 'Group\ViewHelper\ButtonMembership',
        ]);
    }

    /**
     * @param HookEvent $event
     */
    public function onRoutingStart(HookEvent $event)
    {
        $routing = $event->getPayload();

        if (!$routing instanceof RoutingManager) return;

        $routing = \App::routingService();

        $routing->addRoute('groups', [
            'uri'      => 'groups',
            'defaults' => [
                'controller' => '\Group\Controller\HomeController',
                'action'     => 'browse-group',
            ],
        ]);

        $routing->addRoute('group_my', [
            'uri'      => 'my-groups',
            'defaults' => [
                'controller' => '\Group\Controller\HomeController',
                'action'     => 'my-group',
            ],
        ]);

        $routing->addRoute('group_add', [
            'uri'      => 'add-group',
            'defaults' => [
                'controller' => '\Group\Controller\HomeController',
                'action'     => 'create-group',
            ],
        ]);

        $routing->getRoute('profile')
            ->addFilter(new FilterStuff([
                'stuff'      => 'groups',
                'controller' => '\Group\Controller\ProfileController',
                'action'     => 'browse-group']));

        $routing->addRoute('group_profile', [
            'uri'      => 'group/<profileId>(/<stuff>)',
            'uri_expr' => [
                'stuff' => '.+',
            ],
            'defaults' => [
                'controller'  => '\Group\Controller\ProfileController',
                'profileType' => 'group',
            ]
        ])->forward('profile');
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleStylesheet(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof SimpleContainer) return;

        $payload->add('platform/group', 'platform/group/main');
    }

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/group/main'])
            ->addPrimaryBundle('platform/group/main');
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/group/main']);
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