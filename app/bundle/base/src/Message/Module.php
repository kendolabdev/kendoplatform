<?php

namespace Message;


/**
 * Class Module
 *
 * @package Message
 */
class Module extends \Picaso\Application\Module
{

    /**
     * @return bool
     */
    public function start()
    {
        $this->routing();

        \App::viewHelper()->addClassMaps([
            'btnChat'        => '\Message\ViewHelper\ButtonChat',
            'btnMessage'     => '\Message\ViewHelper\ButtonMessage',
            'btnBearMessage' => '\Message\ViewHelper\ButtonBearMessage',
        ]);
    }

    private function routing()
    {
        $routing = \App::routingService();

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
     * @return bool
     */
    public function complete()
    {
        // TODO: Implement bootComplete() method.
    }
}