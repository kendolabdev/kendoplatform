<?php
namespace Layout;

/**
 * Class Module
 *
 * @package Layout
 */
class Module extends \Picaso\Application\Module
{
    /**
     * start theme
     */
    public function start()
    {
        \App::routingService()
            ->addRoute('layout_theme', [
                'uri'      => 'layout/select-theme',
                'defaults' => [
                    'controller' => '\Layout\Controller\HomeController',
                    'action'     => 'select-theme',
                ]
            ]);
    }
}