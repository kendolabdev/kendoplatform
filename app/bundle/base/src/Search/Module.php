<?php
namespace Search;

/**
 * Class Module
 *
 * @package Search
 */
class Module extends \Picaso\Application\Module
{

    /**
     * boot start
     */
    public function start()
    {
        \App::routingService()
            ->addRoute('search', [
                'uri'      => 'search',
                'defaults' => [
                    'controller' => 'Search\Controller\HomeController',
                    'action'     => 'browse',
                ],
            ]);
    }
}