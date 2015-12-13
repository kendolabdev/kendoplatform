<?php

namespace Platform\Page\Service;

use Kendo\Event\EventListener;
use Kendo\Event\HookEvent;
use Kendo\Event\SimpleContainer;
use Kendo\Routing\FilterProfileSlug;
use Kendo\Routing\FilterStuff;
use Kendo\Routing\RoutingManager;
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
            'btnPageMembership' => '\Page\ViewHelper\ButtonMembership'
        ]);

    }

    /**
     * @param HookEvent $event
     */
    public function onRoutingStart(HookEvent $event)
    {
        $routing = $event->getPayload();

        if (!$routing instanceof RoutingManager) return;

        $routing->addRoute('pages', [
            'uri'      => 'pages',
            'defaults' => [
                'controller' => '\Page\Controller\HomeController',
                'action'     => 'browse-page',
            ],
        ]);

        $routing->addRoute('page_add', [
            'uri'      => 'add-page',
            'defaults' => [
                'controller' => '\Page\Controller\HomeController',
                'action'     => 'create-page',
            ],
        ]);

        $routing->addRoute('page_my', [
            'uri'      => 'my-pages',
            'defaults' => [
                'controller' => '\Page\Controller\HomeController',
                'action'     => 'my-page',
            ],
        ]);

        $routing->getRoute('cardhover')
            ->addFilter(new FilterStuff([
                'stuff'      => 'page',
                'controller' => '\Page\Controller\Ajax\Cardhover',
                'action'     => 'preview',
            ]));

        $routing->getRoute('profile')
            ->addFilter(new FilterStuff([
                'stuff'      => 'pages',
                'controller' => '\Page\Controller\ProfileController',
                'action'     => 'browse-page']));

        $routing->addRoute('page_slug', [
            'uri'      => '<name>(/<stuff>)',
            'uri_expr' => [
                'stuff' => '.+',
            ],
            'defaults' => [
                'controller'  => '\Page\Controller\ProfileController',
                'profileType' => 'page',
            ]
        ])->addFilter(new FilterProfileSlug([
            'table'  => 'platform_page',
            'token'  => 'name',
            'wheres' => 'profile_name=?'
        ]))->forward('profile');

        $routing->addRoute('page_profile', [
            'uri'      => 'page/<profileId>(/<stuff>)',
            'uri_expr' => [
                'stuff' => '.+',
            ],
            'defaults' => [
                'controller'  => '\Page\Controller\ProfileController',
                'profileType' => 'page',
            ]
        ])->forward('profile');
    }

    /**
     * @param \Kendo\Event\HookEvent $event
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