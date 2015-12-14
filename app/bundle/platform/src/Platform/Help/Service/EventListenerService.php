<?php
namespace Platform\Help\Service;

use Kendo\Hook\EventListener;
use Kendo\Assets\Requirejs;
use Kendo\Hook\HookEvent;
use Kendo\Routing\RoutingManager;

class EventListenerService extends EventListener
{

    /**
     * @param HookEvent $event
     */
    public function onRoutingStart(HookEvent $event)
    {
        $routing = $event->getPayload();

        if (!$routing instanceof RoutingManager) return;

        $routing->addRoute('help_page', [
            'uri'      => 'help/page/<page>',
            'defaults' => [
                'controller' => 'Help\Controller\HomeController',
                'action'     => 'view-page',
            ],
        ]);

        $routing->addRoute('help', [
            'uri'      => 'help(/<category>)(/<topic>)(/<post>)',
            'defaults' => [
                'controller' => 'Help\Controller\HomeController',
                'action'     => 'view',
            ],
        ]);
    }

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/help/main'])
            ->addPrimaryBundle('platform/help/main');
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/help/main']);
    }
}