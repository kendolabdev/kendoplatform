<?php

namespace Platform\User\Service;

use Kendo\Http\RoutingResult;
use Kendo\Http\RoutingManager;
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

        $routing->add([
            'name'     => 'members',
            'uri'      => 'members',
            'defaults' => [
                'controller' => 'Platform\User\Controller\HomeController',
                'action'     => 'browse-user'
            ],
        ]);

        $routing->add([
            'name'     => 'find_friends',
            'uri'      => 'find-friends',
            'defaults' => [
                'controller' => 'Platform\User\Controller\HomeController',
                'action'     => 'find-friend',
            ],
        ]);

        $routing->add([
            'name'     => 'forgot_password',
            'uri'      => 'forgot-password',
            'defaults' => [
                'controller' => 'Platform\User\Controller\AuthController',
                'action'     => 'forgot-password',
            ],
        ]);

        $routing->add([
            'name'     => 'login',
            'uri'      => 'login',
            'defaults' => [
                'controller' => 'Platform\User\Controller\AuthController',
                'action'     => 'login',
            ],
        ]);

        $routing->add([
            'name'     => 'login_as',
            'uri'      => 'login-as/<type>/<id>',
            'defaults' => [
                'controller' => 'Platform\User\Controller\AuthController',
                'action'     => 'login-as',
            ],
        ]);

        $routing->add([
            'name'     => 'logout',
            'uri'      => 'logout',
            'defaults' => [
                'controller' => 'Platform\User\Controller\AuthController',
                'action'     => 'logout',
            ],
        ]);

        $routing->add([
            'name'     => 'register',
            'uri'      => 'register',
            'defaults' => [
                'controller' => 'Platform\User\Controller\RegisterController',
                'action'     => 'index',
            ],
        ]);

        $routing->add([
            'name'     => 'edit_profile',
            'uri'      => 'user/edit-profile',
            'defaults' => [
                'controller' => 'Platform\User\Controller\ProfileController',
                'action'     => 'edit',
            ],
        ]);

        $routing->add([
            'name'     => 'user_settings',
            'uri'      => 'settings(/<action>)',
            'defaults' => [
                'controller' => 'Platform\User\Controller\SettingsController',
                'action'     => 'account',
            ],
        ]);

        $routing->add([
            'name'         => 'cardhover/user',
            'replacements' => [
                '<type>' => 'user',
            ],
            'defaults'     => [
                'controller' => 'Platform\User\Controller\Ajax\CardhoverController',
                'action'     => 'preview',
            ]
        ]);

        $routing->add([
            'name'     => 'user_profile',
            'delegate' => 'profile',
            'uri'      => 'profile/<name>(/<any>)',
            'uri_expr' => [
                'stuff' => '.+',
            ],
            'defaults' => [
                'controller'  => 'Platform\User\Controller\ProfileController',
                'profileType' => 'platform_user'
            ]
        ]);

        $routing->add([
            'name'         => 'profile/friends',
            'replacements' => [
                '<any>' => 'friends',
            ],
            'defaults'     => ['action'     => 'browse-member'
            ]
        ]);

        $routing->add([
            'name'         => 'profile/about',
            'replacements' => [
                '<any>' => 'about',
            ],
            'defaults'     => ['action'     => 'view-about']
        ]);
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     *
     * @return bool
     */
    public function onFilterProfileNameRun(HookEvent $event)
    {
        $result = $event->getPayload();

        if (!$result instanceof RoutingResult)
            return false;

        $name = $result->get('name');

        $entry = \App::table('platform_user')
            ->select()
            ->where('profile_name=? or user_id=?', (string)$name)
            ->one();

        if (!$entry) {
            return false;
        }

        $event->append([
            'controller'  => 'Platform\Feed\Controller\ProfileController',
            'action'      => 'timeline',
            'profileType' => $entry->getType(),
            'profileId'   => $entry->getId(),
        ]);

        return true;
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
            'label' => \App::text('user . members'),
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