<?php

namespace Platform\Message\Service;

use Kendo\Hook\EventListener;
use Kendo\Assets\Requirejs;
use Kendo\Hook\HookEvent;
use Kendo\Hook\SimpleContainer;
use Kendo\Routing\RoutingManager;
use Kendo\View\ViewHelper;

/**
 * Class EventHandlerService
 *
 * @package Message\Service
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
            'btnChat'        => '\Platform\Message\ViewHelper\ButtonChat',
            'btnMessage'     => '\Platform\Message\ViewHelper\ButtonMessage',
            'btnBearMessage' => '\Platform\Message\ViewHelper\ButtonBearMessage',
        ]);
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleStylesheet(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof SimpleContainer) return;

        $payload->add('platform/message', 'platform/message/main');
    }

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/message/main'])
            ->addPrimaryBundle('platform/message/main');
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/message/main']);
    }

    /**
     * @param $item
     *
     * @return bool
     */
    public function onMenuMainMessages($item)
    {
        if (!app()->auth()->logged())
            return false;

        $item['class'] = 'visible-xs ni-message';

        return $item;
    }


    /**
     * @param HookEvent $event
     */
    public function onRoutingStart(HookEvent $event)
    {
        $routing = $event->getPayload();

        if (!$routing instanceof RoutingManager) return;

        $routing->add([
            'name'     => 'messages',
            'uri'      => 'messages',
            'defaults' => [
                'controller' => 'Platform\Message\Controller\HomeController',
                'action'     => 'inbox-message',
            ],
        ]);

        $routing->add([
            'name'     => 'message_inbox',
            'uri'      => 'messages',
            'defaults' => [
                'controller' => 'Platform\Message\Controller\HomeController',
                'action'     => 'inbox-message',
            ],
        ]);

        $routing->add([
            'name'     => 'message_unread',
            'uri'      => 'unread-messages',
            'defaults' => [
                'controller' => 'Platform\Message\Controller\HomeController',
                'action'     => 'unread-message',
            ],
        ]);

        $routing->add([
            'name'     => 'message_sent',
            'uri'      => 'sent-message',
            'defaults' => [
                'controller' => 'Platform\Message\Controller\HomeController',
                'action'     => 'sent-message',
            ],
        ]);

        $routing->add([
            'name'     => 'message_compose',
            'uri'      => 'compose-message(/<recipientType>)(/<recipientId>)',
            'defaults' => [
                'controller' => 'Platform\Message\Controller\HomeController',
                'action'     => 'compose-message',
            ],
        ]);
    }
}