<?php

namespace Platform\Group\Service;

use Kendo\Http\FilterStuff;
use Kendo\Routing\RoutingManager;
use Kendo\View\ViewHelper;
use Platform\Invitation\Model\Invitation;
use Kendo\Hook\EventListener;
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
            'btnGroupMembership' => '\Platform\Group\ViewHelper\ButtonMembership',
        ]);
    }

    /**
     * @param HookEvent $event
     */
    public function onRoutingStart(HookEvent $event)
    {
        $routing = $event->getPayload();

        if (!$routing instanceof RoutingManager) return;


        $routing->add([
            'name'     => 'groups',
            'uri'      => 'groups',
            'defaults' => [
                'controller' => 'Platform\Group\Controller\HomeController',
                'action'     => 'browse-group',
            ],
        ]);

        $routing->add([
            'name'     => 'group_my',
            'uri'      => 'my-groups',
            'defaults' => [
                'controller' => 'Platform\Group\Controller\HomeController',
                'action'     => 'my-group',
            ],
        ]);

        $routing->add([
            'name'     => 'group_add',
            'uri'      => 'add-group',
            'defaults' => [
                'controller' => 'Platform\Group\Controller\HomeController',
                'action'     => 'create-group',
            ],
        ]);

        $routing->add([
            'name'     => 'group_profile',
            'delegate' => 'profile',
            'uri'      => 'groups/<name>(/<any>)',
            'uri_expr' => [
                'any' => '.+',
            ],
            'defaults' => [
                'controller' => 'Platform\Group\Controller\ProfileController',
            ]
        ]);
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

        app()->relation()->acceptMembershipRequest($poster, $parent, false);
    }

    /**
     * @param $item
     *
     * @return mixed
     */
    public function onProfileMenuItemGroups($item)
    {
        $profile = app()->registryService()->get('profile');


        if (!$profile instanceof User)
            return false;

        if (!$profile->authorize('group__group_tab_exists'))
            return false;

        if (!app()->aclService()->pass($profile, 'group__group_tab_view'))
            return false;

        $item['href'] = $profile->toHref(['any' => 'groups']);

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
            'label' => app()->text('group.groups'),
            'value' => app()->groupService()->getAdminStatisticCount(),
        ];

        $payload->__set('stats', $stats);
    }
}