<?php

namespace Platform\Core\Service;

use Kendo\Hook\EventListener;
use Kendo\Assets\Requirejs;
use Kendo\Hook\HookEvent;
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
            'btnBlock' => '\Platform\Core\ViewHelper\ButtonBlock',
        ]);
    }

    /**
     * @param HookEvent $event
     */
    public function onRoutingStart(HookEvent $event)
    {
        $routing = $event->getPayload();

        if (!$routing instanceof RoutingManager) return;

        $routing->add([
                'name'     => 'ajax',
                'class'    => '\Kendo\Routing\RouterAjax',
                'uri'      => 'ajax(/<any>)',
                'uri_expr' => ['any' => '.+'],
                'defaults' => ['prefix' => '',]]
        );

        $routing->add([
                'name'     => 'admin',
                'class'    => '\Kendo\Routing\RouterAdmin',
                'uri'      => 'admin(/<any>)',
                'uri_expr' => ['any' => '.+'],
                'defaults' => ['prefix' => 'admin',]]
        );

        $routing->add([
            'name'     => 'cardhover',
            'uri'      => 'cardhover/<type>/<id>',
            'uri_expr' => [
                'type' => '\w+',
                'id'   => '\d+',
            ]
        ]);

        $routing->add([
            'name'     => 'home',
            'uri'      => '/',
            'defaults' => [
                'controller' => 'Platform\Core\Controller\HomeController',
            ],
        ]);

        $routing->add([
            'name'     => 'ref_link',
            'uri'      => 'ref/<type>/<id>',
            'uri_expr' => [
                'type' => '\w+',
                'id'   => '\d+'
            ],
            'defaults' => [
                'controller' => 'Platform\Core\Controller\HomeController',
                'action'     => 'ref',
            ],
        ]);

        $routing->add([
            'name'     => 'profile',
            'class'    => '\Kendo\Routing\RouterProfileName',
            'uri'      => '<name>(/<any>)',
            'uri_expr' => [
                'any' => '.+',
            ],
            'defaults' => [
                'controller' => 'Platform\Core\Controller\ProfileController',
                'action'     => 'index',
            ]
        ]);

        $routing->add([
            'name'     => 'indev',
            'uri'      => 'indev/<action>',
            'defaults' => [
                'controller' => 'Platform\Core\Controller\IndevController'
            ]
        ]);

        $routing->add([
            'name'     => 'maintenance',
            'uri'      => 'maintenance',
            'defaults' => [
                'controller' => 'Platform\Core\Controller\MaintenanceController'
            ]
        ]);
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
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
            'kd'         => 'kendo/core/main'
        ])
            ->shim('bootstrap', ['jquery'], 'bootstrap')
            ->shim('jqueryui', ['jquery'], 'jqueryui')
            ->shim('underscore', ['jquery'], '_')
            ->addDependency([
                'jquery',
                'underscore',
                'bootstrap',
                'jquery-ext',
                'kd',
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

        $staticUrl = app()->staticBaseUrl();

        $requirejs->baseUrl($staticUrl . 'static/jscript');

        // you have shim to bundles, do not shim here!
        $requirejs->addPaths([
            'jquery'     => 'kendo/jquery/jquery',
            'bootstrap'  => 'kendo/bootstrap/bootstrap',
            'jqueryui'   => 'kendo/jquery-ui/jqueryui',
            'underscore' => 'kendo/underscore/underscore.min',
            'jquery-ext' => 'kendo/jquery-ext/jquery-ext',
            'kd'         => 'kendo/core/main'
        ])
            ->addDependency([
                'jquery',
                'underscore',
                'bootstrap',
                'kd',
                'jquery-ext'
            ])
            ->addPrimaryBundle([
                'jquery',
                'underscore',
                'bootstrap',
                'kd',
                'jquery-ext'
            ]);

        $options = [
            'baseUrl'   => KENDO_BASE_URL,
            'staticUrl' => $staticUrl,
            'logged'    => app()->auth()->logged(),
            'isUser'    => app()->auth()->isUser()
        ];

        $script = '$kd.setOptions(' . json_encode($options, JSON_PRETTY_PRINT) . ')';
        $requirejs->prependScript('options', $script);
    }


    /**
     *
     */
    public function onBeforeRenderAssetsHeader()
    {
        $assets = app()->assetService();

        $staticUrl = app()->staticBaseUrl();

        $assets->js()
            ->prependAll([
                'requirejs' => [
                    'src' => $staticUrl . 'static/jscript/dist/require.js',
                ],
            ]);


        $themeId = app()->layouts()->getThemeId();

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
            ->add('base', '$kd.setOptions(' . json_encode($options) . ')');
    }
}