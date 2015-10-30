<?php

namespace Group;

use Picaso\Routing\FilterStuff;


/**
 * Class Module
 *
 * @package Group
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
            'btnGroupMembership' => 'Group\ViewHelper\ButtonMembership',
        ]);
    }

    private function routing()
    {
        $routing = \App::routing();

        $routing->addRoute('groups', [
            'uri'      => 'groups',
            'defaults' => [
                'controller' => '\Group\Controller\HomeController',
                'action'     => 'browse-group',
            ],
        ]);

        $routing->addRoute('group_my', [
            'uri'      => 'my-groups',
            'defaults' => [
                'controller' => '\Group\Controller\HomeController',
                'action'     => 'my-group',
            ],
        ]);

        $routing->addRoute('group_add', [
            'uri'      => 'add-group',
            'defaults' => [
                'controller' => '\Group\Controller\HomeController',
                'action'     => 'create-group',
            ],
        ]);

        $routing->getRoute('profile')
            ->addFilter(new FilterStuff([
                'stuff'      => 'groups',
                'controller' => '\Group\Controller\ProfileController',
                'action'     => 'browse-group']));

        $routing->addRoute('group_profile', [
            'uri'      => 'group/<profileId>(/<stuff>)',
            'uri_expr' => [
                'stuff' => '.+',
            ],
            'defaults' => [
                'controller'  => '\Group\Controller\ProfileController',
                'profileType' => 'group',
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