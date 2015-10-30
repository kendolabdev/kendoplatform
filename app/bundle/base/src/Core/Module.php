<?php

namespace Core;

use Picaso\Routing\FilterPrefix;

/**
 * Class Module
 *
 * @package Core
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
            'btnBlock' => '\Core\ViewHelper\ButtonBlock',
        ]);
    }

    /**
     * Add routing
     */
    private function routing()
    {
        $routing = \App::routing();

        $routing->addRoute('ajax', [
                'uri'      => 'ajax/<stuff>',
                'uri_expr' => [
                    'stuff' => '.+',
                ],
                'defaults' => []]
        )->addFilter(new FilterPrefix(
            [
                'prefix' => 'ajax'
            ]
        ));

        $routing->addRoute('cardhover', [
            'uri'      => 'cardhover/<id>/<stuff>',
            'uri_expr' => [
                'type' => '\w+',
                'id'   => '\d+',
            ]
        ]);

        $routing->addRoute('api', [
                'uri'      => 'api/<stuff>',
                'uri_expr' => [
                    'stuff' => '.+',
                ],
                'defaults' => []]
        )->addFilter(new FilterPrefix(
            [
                'prefix' => 'api'
            ]
        ));

        $routing->addRoute('admin', [
                'uri'      => 'admin/<stuff>',
                'uri_expr' => [
                    'stuff' => '.+',
                ],
                'defaults' => [
                    'stuff' => 'core/dashboard/index'
                ]]
        )->addFilter(new FilterPrefix(['prefix' => 'admin']));

        $routing->addRoute('admin_dashboard', [
            'uri'      => 'admin',
            'defaults' => [
                'controller' => '\Core\Controller\Admin\DashboardController',
                'action'     => 'index',
            ]
        ]);

        $routing->addRoute('search', [
            'uri'      => 'search',
            'defaults' => [
                'controller' => '\Core\Controller\SearchController',
                'action'     => 'index',
            ]
        ]);

        $routing->addRoute('home', [
            'uri'      => '/',
            'defaults' => [
                'controller' => '\Core\Controller\HomeController',
            ],
        ]);

        $routing->addRoute('ref_link', [
            'uri'      => 'ref/<type>/<id>',
            'uri_expr' => [
                'type' => '\w+',
                'id'   => '\d+'
            ],
            'defaults' => [
                'controller' => '\Core\Controller\HomeController',
                'action'     => 'ref',
            ],
        ]);

        $routing->addRoute('profile', [
            'uri'      => '<name>(/<stuff>)',
            'uri_expr' => [
                'name'  => '',
                'stuff' => '.+',
            ],
        ]);


        $routing->addRoute('indev(/<action>)', [
            'uri'      => 'indev',
            'defaults' => [
                'controller' => '\Core\Controller\IndevController'
            ]
        ]);

        $routing->addRoute('maintenance', [
            'uri'      => 'maintenance',
            'defaults' => [
                'controller' => '\Core\Controller\MaintenanceController'
            ]
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