<?php

namespace Platform\Page\Service;

use Kendo\Hook\EventListener;
use Kendo\Hook\HookEvent;
use Kendo\Hook\SimpleContainer;
use Kendo\Http\RoutingManager;
use Kendo\View\View;
use Kendo\View\ViewHelper;
use Platform\User\Model\User;

/**
 * Class EventHandlerService
 *
 * @package Page\Service
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
            'btnPageMembership' => '\Platform\Page\ViewHelper\ButtonMembership'
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
            'name'     => 'pages',
            'uri'      => 'pages',
            'defaults' => [
                'controller' => 'Platform\Page\Controller\HomeController',
                'action'     => 'browse-page',
            ],
        ]);

        $routing->add([
            'name'     => 'page_add',
            'uri'      => 'add-page',
            'defaults' => [
                'controller' => 'Platform\Page\Controller\HomeController',
                'action'     => 'create-page',
            ],
        ]);

        $routing->add([
            'name'     => 'page_my',
            'uri'      => 'my-pages',
            'defaults' => [
                'controller' => 'Platform\Page\Controller\HomeController',
                'action'     => 'my-page',
            ],
        ]);

        $routing->add([
            'name'         => 'cardhover/page',
            'replacements' => [
                '<type>' => 'page',
            ],
            'defaults'     => [
                'controller' => 'Platform\Page\Controller\Ajax\Cardhover',
                'action'     => 'preview',
            ]
        ]);

        $routing->add([
            'name'         => 'profile/pages',
            'replacements' => [
                '<any>' => 'pages',
            ],
            'defaults'     => [
                'namespace'  => 'Platform\Page',
                'controller' => 'ProfileController',
                'action'     => 'browse-page'
            ]]);

        $routing->add([
            'name'     => 'page_profile',
            'delegate' => 'profile',
            'uri'      => 'pages/<name>(/<any>)',
            'uri_expr' => [
                'any' => '.+',
            ],
            'defaults' => [
                'controller'  => 'Platform\Page\Controller\ProfileController',
                'profileType' => 'page',
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

        $payload->add('platform/page', 'platform/page/main');
    }

    /**
     * @param $item
     *
     * @return mixed
     */
    public function onProfileMenuItemPages($item)
    {
        $profile = \App::registryService()->get('profile');

        if (!$profile instanceof User)
            return false;

        if (!$profile->authorize('page__page_tab_exists'))
            return false;

        if (!\App::aclService()->pass($profile, 'page__page_tab_view'))
            return false;

        $item['href'] = $profile->toHref(['stuff' => 'pages']);

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

        $stats['page'] = [
            'label' => \App::text('page.pages'),
            'value' => \App::pageService()->getActivePageCount(),
        ];

        $payload->__set('stats', $stats);
    }
}