<?php

namespace Base\Page;

use Kendo\Routing\FilterProfileSlug;
use Kendo\Routing\FilterStuff;


/**
 * Class Module
 *
 * @package Page
 */
class Module extends \Kendo\Application\Module
{

    /**
     * @return bool
     */
    public function start()
    {
        $this->routing();

        \App::viewHelper()->addClassMaps([
            'btnPageMembership' => '\Page\ViewHelper\ButtonMembership'
        ]);
    }

    private function routing()
    {
        $routing = \App::routingService();

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
            'table'  => 'base_page',
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
     * @return bool
     */
    public function complete()
    {
        // TODO: Implement bootComplete() method.
    }
}