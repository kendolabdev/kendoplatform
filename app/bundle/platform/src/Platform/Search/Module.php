<?php
namespace Platform\Search;

/**
 * Class Module
 *
 * @package Platform\Search
 */
class Module extends \Kendo\Application\Module
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