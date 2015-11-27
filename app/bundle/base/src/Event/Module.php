<?php

namespace Event;

use Picaso\Routing\FilterStuff;

/**
 * Class Module
 *
 * @package Event
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
            'btnEventMembership' => '\Event\ViewHelper\ButtonMembership',
        ]);
    }

    /**
     * Add class routing
     */
    private function routing()
    {
        $routing = \App::routingService();

        $routing->addRoute('events', [
            'uri'      => 'events',
            'defaults' => [
                'controller' => '\Event\Controller\HomeController',
                'action'     => 'browse-event',
            ],
        ]);

        $routing->addRoute('event_my', [
            'uri'      => 'my-events',
            'defaults' => [
                'controller' => '\Event\Controller\HomeController',
                'action'     => 'my-event',
            ],
        ]);

        $routing->addRoute('event_add', [
            'uri'      => 'add-event',
            'defaults' => [
                'controller' => '\Event\Controller\HomeController',
                'action'     => 'create-event',
            ],
        ]);

        $routing->getRoute('profile')
            ->addFilter(new FilterStuff([
                'stuff'      => 'events',
                'controller' => '\Event\Controller\ProfileController',
                'action'     => 'browse-event']));

        $routing->addRoute('event_profile', [
            'uri'      => 'event/<profileId>(/<stuff>)',
            'uri_expr' => ['stuff' => '.+'],
            'defaults' => [
                'controller'  => '\Event\Controller\ProfileController',
                'profileType' => 'event',
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