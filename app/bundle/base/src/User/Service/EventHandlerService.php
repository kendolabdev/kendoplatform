<?php

namespace User\Service;

use Invitation\Model\Invitation;
use Page\Model\Page;
use Picaso\Application\EventHandler;
use Picaso\Content\Poster;
use Picaso\Hook\HookEvent;
use Picaso\View\View;
use User\Model\User;

/**
 * Class EventHandlerService
 *
 * @package User\Service
 */
class EventHandlerService extends EventHandler
{

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

        \App::relation()->acceptMembershipRequest($poster, $parent, false);
    }

    /**
     * @param HookEvent $event
     */
    public function onRenderActivityComposerFooter(HookEvent $event)
    {

        $payload = $event->getPayload();

        if (false == \App::auth()->logged()) return;

        if (!$payload instanceof Poster) return;

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
        $profile = \App::registry()->get('profile');

        if ($profile instanceof User)
            return false;

        if ($profile instanceof Page)
            return false;

        if (!$profile instanceof Poster)
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
            'value' => \App::service('user')->getActiveUserCount(),
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
        $profile = \App::registry()->get('profile');

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
        $profile = \App::registry()->get('profile');

        if (!$profile instanceof User)
            return false;

        if (!$profile->authorize('user__friend_tab_exists'))
            return false;

        if (!\App::acl()->pass($profile, 'user__friend_tab_view'))
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