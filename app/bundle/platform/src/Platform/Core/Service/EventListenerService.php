<?php

namespace Platform\Core\Service;

use Kendo\Event\EventListener;
use Kendo\Assets\Requirejs;
use Kendo\Event\HookEvent;
use Kendo\Routing\FilterPrefix;
use Kendo\Routing\RoutingManager;
use Kendo\View\ViewHelper;

/**
 * Class EventHandlerService
 *
 * @package Core\Service
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
            'btnBlock' => '\Core\ViewHelper\ButtonBlock',
        ]);
    }

    /**
     * @param HookEvent $event
     */
    public function onRoutingStart(HookEvent $event)
    {
        $routing = $event->getPayload();

        if (!$routing instanceof RoutingManager) return;

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
                'controller' => '\Platform\Core\Controller\Admin\DashboardController',
                'action'     => 'index',
            ]
        ]);

        $routing->addRoute('search', [
            'uri'      => 'search',
            'defaults' => [
                'controller' => '\Platform\Core\Controller\SearchController',
                'action'     => 'index',
            ]
        ]);

        $routing->addRoute('home', [
            'uri'      => '/',
            'defaults' => [
                'controller' => '\Platform\Core\Controller\HomeController',
            ],
        ]);

        $routing->addRoute('ref_link', [
            'uri'      => 'ref/<type>/<id>',
            'uri_expr' => [
                'type' => '\w+',
                'id'   => '\d+'
            ],
            'defaults' => [
                'controller' => '\Platform\Core\Controller\HomeController',
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
                'controller' => '\Platform\Core\Controller\IndevController'
            ]
        ]);

        $routing->addRoute('maintenance', [
            'uri'      => 'maintenance',
            'defaults' => [
                'controller' => '\Platform\Core\Controller\MaintenanceController'
            ]
        ]);
    }

    /**
     * @param \Kendo\Event\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addPaths([
            'jquery'     => 'kendo/jquery/jquery',
            'bootstrap'  => 'kendo/bootstrap/bootstrap',
            'jqueryui'   => 'kendo/jquery-ui/jqueryui',
            'underscore' => 'kendo/underscore/underscore.min',
            'jquery-ext' => 'kendo/jquery-ext/jquery-ext',
            'platform'   => 'kendo/platform/platform'
        ])
            ->shim('bootstrap', ['jquery'], 'bootstrap')
            ->shim('jqueryui', ['jquery'], 'jqueryui')
            ->shim('underscore', ['jquery'], '_')
            ->addDependency([
                'jquery',
                'underscore',
                'bootstrap',
                'platform',
                'jquery-ext',
            ]);
    }


    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event)
    {

        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs)
            return;

        $staticUrl = \App::staticBaseUrl();

        $requirejs->baseUrl($staticUrl . 'static/jscript');

        // you have shim to bundles, do not shim here!
        $requirejs->addPaths([
            'jquery'     => 'kendo/jquery/jquery',
            'bootstrap'  => 'kendo/bootstrap/bootstrap',
            'jqueryui'   => 'kendo/jquery-ui/jqueryui',
            'underscore' => 'kendo/underscore/underscore.min',
            'jquery-ext' => 'kendo/jquery-ext/jquery-ext',
            'platform'   => 'kendo/platform/platform'
        ])
            ->addDependency([
                'jquery',
                'underscore',
                'bootstrap',
                'platform',
                'jquery-ext'
            ])
            ->addPrimaryBundle([
                'jquery',
                'underscore',
                'bootstrap',
                'platform',
                'jquery-ext'
            ]);

        $options = [
            'baseUrl'   => KENDO_BASE_URL,
            'staticUrl' => $staticUrl,
            'logged'    => \App::authService()->logged(),
            'isUser'    => \App::authService()->isUser()
        ];

        $script = 'K.setOptions(' . json_encode($options, JSON_PRETTY_PRINT) . ')';
        $requirejs->prependScript('options', $script);
    }


    /**
     *
     */
    public function onBeforeRenderAssetsHeader()
    {
        $assets = \App::assetService();

        $staticUrl = \App::staticBaseUrl();

        $assets->js()
            ->prependAll([
                'requirejs' => [
                    'src' => $staticUrl . 'static/jscript/dist/require.js',
                ],
            ]);


        $themeId = \App::layoutService()->getThemeId();

        if (!empty($_COOKIE['themeId'])) {
            $themeId = $_COOKIE['themeId'];
        }

        $assets->link()
            ->prependAll([
                'favicon' => [
                    'id'   => 'favicon',
                    'href' => $staticUrl . 'static/favicon.ico',
                    'rel'  => 'shortcut icon favicon',
                ],
                'main'    => [
                    'rel'  => 'stylesheet',
                    'href' => $staticUrl . 'static/theme/' . $themeId . '/stylesheets/bundle.css'
                ]
            ]);

        $options = [
            'baseUrl' => KENDO_BASE_URL,
        ];

        $assets->script()
            ->add('base', 'K.setOptions(' . json_encode($options) . ')');
    }
}