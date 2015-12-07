<?php

namespace Core\Service;

use Kendo\Application\EventHandler;
use Kendo\Assets\Requirejs;
use Kendo\Hook\HookEvent;

/**
 * Class EventHandlerService
 *
 * @package Core\Service
 */
class EventHandlerService extends EventHandler {
    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event) {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addPaths([
            'jquery'     => 'kendo/jquery/jquery',
            'bootstrap'  => 'kendo/bootstrap/bootstrap',
            'jqueryui'   => 'kendo/jquery-ui/jqueryui',
            'underscore' => 'kendo/underscore/underscore.min',
            'jquery-ext' => 'kendo/jquery-ext/jquery-ext',
            'platform'    => 'kendo/platform/platform'
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
    public function onRequirejsRender(HookEvent $event) {

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
            'platform'    => 'kendo/platform/platform'
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
            'baseUrl'   => Kendo_BASE_URL,
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
    public function onBeforeRenderAssetsHeader() {
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
            'baseUrl' => Kendo_BASE_URL,
        ];

        $assets->script()
            ->add('base', 'K.setOptions(' . json_encode($options) . ')');
    }
}