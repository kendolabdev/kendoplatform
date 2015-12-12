<?php

namespace Platform\User;

use Kendo\Routing\FilterProfileSlug;
use Kendo\Routing\FilterStuff;


/**
 * Class Module
 *
 * @package Platform\User
 */
class Module extends \Kendo\Application\Module
{

    /**
     * @return bool
     */
    public function start()
    {
        $this->routing();

        \App::authService()->restore();

        \App::viewHelper()->addClassMaps([
            'btnFriendCount'    => '\Platform\User\ViewHelper\ButtonMemberCount',
            'btnUserMembership' => '\Platform\User\ViewHelper\ButtonMembership',
            'btnBearAccount'    => '\Platform\User\ViewHelper\ButtonBearAccount',
            'btnTopbarViewer'   => '\Platform\User\ViewHelper\ButtonTopbarViewer',
            'btnLoginAs'        => '\Platform\User\ViewHelper\ButtonLoginAs',
        ]);

    }

    /**
     * @return bool
     */
    public function complete()
    {
        // TODO: Implement bootComplete() method.


    }

    private function routing()
    {
        $routing = \App::routingService();

        $routing->addRoute('members', [
            'uri'      => 'members',
            'defaults' => [
                'controller' => '\Platform\User\Controller\HomeController',
                'action'     => 'browse-user'
            ],
        ]);

        $routing->addRoute('find_friends', [
            'uri'      => 'find-friends',
            'defaults' => [
                'controller' => '\Platform\User\Controller\HomeController',
                'action'     => 'find-friend',
            ],
        ]);

        $routing->addRoute('forgot_password', [
            'uri'      => 'forgot-password',
            'defaults' => [
                'controller' => '\Platform\User\Controller\AuthController',
                'action'     => 'forgot-password',
            ],
        ]);

        $routing->addRoute('login', [
            'uri'      => 'login',
            'defaults' => [
                'controller' => '\Platform\User\Controller\AuthController',
                'action'     => 'login',
            ],
        ]);

        $routing->addRoute('login_as', [
            'uri'      => 'login-as/<type>/<id>',
            'defaults' => [
                'controller' => '\Platform\User\Controller\AuthController',
                'action'     => 'loginAs',
            ],
        ]);

        $routing->addRoute('logout', [
            'uri'      => 'logout',
            'defaults' => [
                'controller' => '\Platform\User\Controller\AuthController',
                'action'     => 'logout',
            ],
        ]);

        $routing->addRoute('register', [
            'uri'      => 'register',
            'defaults' => [
                'controller' => '\Platform\User\Controller\RegisterController',
                'action'     => 'index',
            ],
        ]);


        $routing->addRoute('edit_profile', [
            'uri'      => 'user/edit-profile',
            'defaults' => [
                'controller' => '\Platform\User\Controller\ProfileController',
                'action'     => 'edit',
            ],
        ]);

        $routing->addRoute('user_settings', [
            'uri'      => 'settings(/<action>)',
            'defaults' => [
                'controller' => '\Platform\User\Controller\SettingsController',
                'action'     => 'account',
            ],
        ]);

        $routing->getRoute('cardhover')
            ->addFilter(new FilterStuff([
                'stuff'      => 'user',
                'controller' => '\Platform\User\Controller\Ajax\CardhoverController',
                'action'     => 'preview',
            ]));

        $routing->addRoute('user_slug', [
            'uri'      => '<name>(/<stuff>)',
            'uri_expr' => [
                'stuff' => '.+',
            ],
            'defaults' => [
                'controller'  => '\Platform\User\Controller\ProfileController',
                'profileType' => 'platform_user',
            ]
        ])->addFilter(new FilterProfileSlug([
            'table'  => 'platform_user',
            'token'  => 'name',
            'wheres' => 'profile_name=?'
        ]))->forward('profile');

        $routing->addRoute('user_profile', [
            'uri'      => 'user/<profileId>(/<stuff>)',
            'uri_expr' => [
                'stuff' => '.+',
            ],
            'defaults' => [
                'controller'  => '\Platform\User\Controller\ProfileController',
                'profileType' => 'platform_user'
            ]
        ])->forward('profile');


        $routing->getRoute('profile')
            ->addFilter(new FilterStuff([
                'stuff'      => 'friends',
                'controller' => '\Platform\User\Controller\ProfileController',
                'action'     => 'browse-member']))
            ->addFilter(new FilterStuff([
                'stuff'      => 'about',
                'controller' => '\Platform\User\Controller\ProfileController',
                'action'     => 'view-about']));
    }
}