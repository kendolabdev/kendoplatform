<?php
namespace Help;

class Module extends \Picaso\Application\Module
{

    public function start()
    {

        $routing = \App::routing();

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
}