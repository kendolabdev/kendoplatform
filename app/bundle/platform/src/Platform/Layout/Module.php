<?php
namespace Platform\Layout;

/**
 * Class Module
 *
 * @package Platform\Layout
 */
class Module extends \Kendo\Application\Module
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