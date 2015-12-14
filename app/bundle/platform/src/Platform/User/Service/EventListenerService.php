<?php

namespace Platform\User\Service;

use Kendo\Routing\FilterProfileSlug;
use Kendo\Routing\FilterStuff;
use Kendo\Routing\RoutingManager;
use Kendo\View\ViewHelper;
use Platform\Invitation\Model\Invitation;
use Platform\Page\Model\Page;
use Kendo\Hook\EventListener;
use Kendo\Assets\Requirejs;
use Kendo\Content\PosterInterface;
use Kendo\Hook\HookEvent;
use Kendo\Hook\SimpleContainer;
use Kendo\View\View;
use Platform\User\Model\User;

/**
 * @codeCoverageIgnore
 *
 * Class EventHandlerService
 *
 * @package Platform\User\Service
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
            'btnFriendCount'    => '\Platform\User\ViewHelper\ButtonMemberCount',
            'btnUserMembership' => '\Platform\User\ViewHelper\ButtonMembership',
            'btnBearAccount'    => '\Platform\User\ViewHelper\ButtonBearAccount',
            'btnTopbarViewer'   => '\Platform\User\ViewHelper\ButtonTopbarViewer',
            'btnLoginAs'        => '\Platform\User\ViewHelper\ButtonLoginAs',
        ]);
    }

    /**
     * @param HookEvent $event
     */
    public function onRoutingStart(HookEvent $event)
    {
        $routing = $event->getPayload();

        if (!$routing instanceof RoutingManager) return;

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

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/user/main'])
            ->addPrimaryBundle('platform/user/main');
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/user/main']);
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleStylesheet(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof SimpleContainer) return;

        $payload->add('platform/user', 'platform/user/main');
    }

    /**
     * @param Invitation $invitation
     */
    public function onAcceptRequestMembershipUser(Invitation $invitation)
    {
        /**
         * current viewer called to accept data
         */
        $poster = $invitation->getPoster();

        $parent = $invitation->getParent();

        \App::relationService()->acceptMembershipRequest($poster, $parent, false);
    }

    /**
     * @param HookEvent $event
     */
    public function onRenderActivityComposerFooter(HookEvent $event)
    {

        $payload = $event->getPayload();

        if (false == \App::authService()->logged()) return;

        if (!$payload instanceof PosterInterface) return;

        $content = \App::viewHelper()->partial('platform/user/partial/composer-footer-add-people');

        $event->append($content);
    }

    /**
     * @param $item
     *
     * @return array|false
     */
    public function onProfileMenuItemMembers($item)
    {
        $profile = \App::registryService()->get('profile');

        if ($profile instanceof User)
            return false;

        if ($profile instanceof Page)
            return false;

        if (!$profile instanceof PosterInterface)
            return false;


        $item['href'] = $profile->toHref(['stuff' => 'members']);

        return $item;
    }

    /**
     * @param HookEvent $event
     */
    public function onAdminStatisticBlockRender(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof View) return;

        $stats = $payload->__get('stats');

        $stats['user'] = [
            'label' => \App::text('user.members'),
            'value' => \App::userService()->getActiveUserCount(),
        ];

        $payload->__set('stats', $stats);
    }


    /**
     * @param $item
     *
     * @return mixed
     */
    public function onProfileMenuItemAbout($item)
    {
        $profile = \App::registryService()->get('profile');

        $item['href'] = $profile->toHref(['stuff' => 'about']);

        return $item;
    }

    /**
     * @param $item
     *
     * @return mixed
     */
    public function onProfileMenuItemFriends($item)
    {
        $profile = \App::registryService()->get('profile');

        if (!$profile instanceof User)
            return false;

        if (!$profile->authorize('user__friend_tab_exists'))
            return false;

        if (!\App::aclService()->pass($profile, 'user__friend_tab_view'))
            return false;

        $item['href'] = $profile->toHref(['stuff' => 'friends']);

        return $item;
    }


    /**
     * Check poster is user
     *
     * @param HookEvent $event
     */
    public function onUserCreated(HookEvent $event)
    {
        $config = \App::setting('register');

        $user = $event->getPayload();

        if (!$user instanceof User) {
            return;
        }

        if (!$user->isVerified()) {
            // start process verify this member
        } else {
            // if active member
        }

        if ($config['email_verify'] = 1) {

        }

        if ($config['approval'] == '2') {

        }

        if ($config['notify_admin']) {

        }

        // process add after to handler all of this case.

        $user->setApproved(1);
        $user->setActive(1);
        $user->save();
    }
}