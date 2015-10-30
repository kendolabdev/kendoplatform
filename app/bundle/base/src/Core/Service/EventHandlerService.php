<?php

namespace Core\Service;

use Picaso\Application\EventHandler;
use Picaso\Hook\HookEvent;

/**
 * Class EventHandlerService
 *
 * @package Core\Service
 */
class EventHandlerService extends EventHandler
{


    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event)
    {

        $require = $event->getPayload();

        $staticUrl = \App::staticBaseUrl();

        $require->baseUrl($staticUrl . 'static/jscript');

        $require->addPaths([
            'jquery' => 'dist/core.bundle',
        ]);

        $options = [
            'baseUrl'   => PICASO_BASE_URL,
            'staticUrl' => $staticUrl,
            'logged'    => \App::auth()->logged(),
            'isUser'    => \App::auth()->isUser()
        ];

        $require->prependScript('options', 'K.setOptions(' . json_encode($options) . ')');
    }


    /**
     *
     */
    public function onBeforeRenderAssetsHeader()
    {
        $assets = \App::assets();

        $staticUrl = \App::staticBaseUrl();

        $assets->headjs()
            ->prependAll([
                'requirejs' => [
                    'src' => $staticUrl . 'static/jscript/dist/require.js',
                ],
            ]);

        $assets->link()
            ->prependAll([
                'favicon'         => [
                    'id'   => 'favicon',
                    'href' => $staticUrl . 'static/favicon.ico',
                    'rel'  => 'shortcut icon favicon',
                ],
                'main'            => [
                    'rel'  => 'stylesheet',
                    'href' => $staticUrl . 'static/legacy/css/main.min.css'
                ],
                'ionic.font'      => [
                    'rel'  => 'stylesheet',
                    'href' => $staticUrl . 'static/legacy/css/ionicons.min.css'
                ],
                'jquery.ui'       => [
                    'rel'  => 'stylesheet',
                    'type' => 'text/css',
                    'href' => $staticUrl . 'static/jquery-ui/jquery-ui.min.css',
                ],
                'jquery.ui.theme' => [
                    'rel'  => 'stylesheet',
                    'type' => 'text/css',
                    'href' => $staticUrl . 'static/jquery-ui/jquery-ui.theme.min.css',
                ]
            ]);

        $options = [
            'baseUrl' => PICASO_BASE_URL,
        ];

        $assets->script()
            ->add('base', 'K.setOptions(' . json_encode($options) . ')');
    }
}