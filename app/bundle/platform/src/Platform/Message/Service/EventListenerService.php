<?php

namespace Platform\Message\Service;

use Kendo\Event\EventListener;
use Kendo\Assets\Requirejs;
use Kendo\Event\HookEvent;
use Kendo\Event\SimpleContainer;
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
            'btnChat'        => '\Message\ViewHelper\ButtonChat',
            'btnMessage'     => '\Message\ViewHelper\ButtonMessage',
            'btnBearMessage' => '\Message\ViewHelper\ButtonBearMessage',
        ]);
    }

    /**
     * @param HookEvent $event
     */
    public function onRoutingStart(HookEvent $event)
    {
        $routing = $event->getPayload();

        if (!$routing instanceof RoutingManager) return;

        $routing->addRoute('messages', [
            'uri'      => 'messages',
            'defaults' => [
                'controller' => '\Message\Controller\HomeController',
                'action'     => 'inbox-message',
            ],
        ]);

        $routing->addRoute('message_inbox', [
            'uri'      => 'messages',
            'defaults' => [
                'controller' => '\Message\Controller\HomeController',
                'action'     => 'inbox-message',
            ],
        ]);

        $routing->addRoute('message_unread', [
            'uri'      => 'unread-messages',
            'defaults' => [
                'controller' => '\Message\Controller\HomeController',
                'action'     => 'unread-message',
            ],
        ]);

        $routing->addRoute('message_sent', [
            'uri'      => 'sent-message',
            'defaults' => [
                'controller' => '\Message\Controller\HomeController',
                'action'     => 'sent-message',
            ],
        ]);

        $routing->addRoute('message_compose', [
            'uri'      => 'compose-message(/<recipientType>)(/<recipientId>)',
            'defaults' => [
                'controller' => '\Message\Controller\HomeController',
                'action'     => 'compose-message',
            ],
        ]);
    }

    /**
     * @param \Kendo\Event\HookEvent $event
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
     * @param \Kendo\Event\HookEvent $event
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
        if (!\App::authService()->logged())
            return false;

        $item['class'] = 'visible-xs ni-message';

        return $item;
    }
}