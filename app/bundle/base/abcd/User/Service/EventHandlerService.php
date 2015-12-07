<?php

namespace User\Service;

use Invitation\Model\Invitation;
use Page\Model\Page;
use Kendo\Application\EventHandler;
use Kendo\Assets\Requirejs;
use Kendo\Content\PosterInterface;
use Kendo\Hook\HookEvent;
use Kendo\Hook\SimpleContainer;
use Kendo\View\View;
use User\Model\User;

/**
 * Class EventHandlerService
 *
 * @package User\Service
 */
class EventHandlerService extends EventHandler
{

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event) {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/user/main'])
            ->addPrimaryBundle('base/user/main');
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/user/main']);
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleStylesheet(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof SimpleContainer) return;

        $payload->add('base/user', 'base/user/main');
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

        $content = \App::viewHelper()->partial('base/user/partial/composer-footer-add-people');

        $event->addResponse($content);
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