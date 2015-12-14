<?php
namespace Platform\Event\Service;

use Kendo\Hook\EventListener;
use Kendo\Assets\Requirejs;
use Kendo\Hook\HookEvent;
use Kendo\Hook\SimpleContainer;
use Kendo\Routing\FilterStuff;
use Kendo\Routing\RoutingManager;
use Kendo\View\View;
use Kendo\View\ViewHelper;
use Platform\User\Model\User;

/**
 * Class EventHandlerService
 *
 * @package Event\Service
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
            'btnEventMembership' => '\Event\ViewHelper\ButtonMembership',
        ]);
    }

    /**
     * @param HookEvent $event
     */
    public function onRoutingStart(HookEvent $event)
    {
        $routing = $event->getPayload();

        if (!$routing instanceof RoutingManager) return;

        $routing->addRoute('events', [
            'uri'      => 'events',
            'defaults' => [
                'controller' => '\Event\Controller\HomeController',
                'action'     => 'browse-event',
            ],
        ]);

        $routing->addRoute('event_my', [
            'uri'      => 'my-events',
            'defaults' => [
                'controller' => '\Event\Controller\HomeController',
                'action'     => 'my-event',
            ],
        ]);

        $routing->addRoute('event_add', [
            'uri'      => 'add-event',
            'defaults' => [
                'controller' => '\Event\Controller\HomeController',
                'action'     => 'create-event',
            ],
        ]);

        $routing->getRoute('profile')
            ->addFilter(new FilterStuff([
                'stuff'      => 'events',
                'controller' => '\Event\Controller\ProfileController',
                'action'     => 'browse-event']));

        $routing->addRoute('event_profile', [
            'uri'      => 'event/<profileId>(/<stuff>)',
            'uri_expr' => ['stuff' => '.+'],
            'defaults' => [
                'controller'  => '\Event\Controller\ProfileController',
                'profileType' => 'event',
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

        $payload->add('platform/event', 'platform/event/main');
    }

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/event/main'])
            ->addPrimaryBundle('platform/event/main');
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/event/main']);
    }

    /**
     * @param $item
     *
     * @return mixed
     */
    public function onProfileMenuItemEvents($item)
    {
        $profile = \App::registryService()->get('profile');

        if (!$profile instanceof User)
            return false;

        if (!$profile->authorize('event__event_tab_exists'))
            return false;


        if (!\App::aclService()->pass($profile, 'event__event_tab_view'))
            return false;

        $item['href'] = $profile->toHref(['stuff' => 'events']);

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

        $stats['event'] = [
            'label' => \App::text('event.events'),
            'value' => \App::eventService()->getEventCount(),
        ];

        $payload->__set('stats', $stats);
    }
}