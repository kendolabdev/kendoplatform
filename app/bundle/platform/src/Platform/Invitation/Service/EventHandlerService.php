<?php
namespace Platform\Invitation\Service;

use Kendo\Application\EventHandler;
use Kendo\Assets\Requirejs;
use Kendo\Content\PosterInterface;
use Kendo\Hook\HookEvent;
use Kendo\Hook\SimpleContainer;
use Platform\User\Model\User;

/**
 * Class EventHandlerService
 *
 * @package Platform\Invitation\Service
 */
class EventHandlerService extends EventHandler
{

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleStylesheet(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof SimpleContainer) return;

        $payload->add('base/invitation', 'base/invitation/main');
    }

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event) {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/invitation/main'])
            ->addPrimaryBundle('base/invitation/main');
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/invitation/main']);
    }

    /**
     * @param $item
     *
     * @return bool
     */
    public function onProfileMenuItemRequests($item)
    {
        $profile = \App::registryService()->get('profile');

        if (!$profile instanceof PosterInterface) return false;

        if (!$profile->viewerIsParent()) return false;

        $item['href'] = $profile->toHref(['stuff' => 'requests']);

        return $item;
    }

    /**
     * @param $item
     *
     * @return bool
     */
    public function onMenuMainInvitations($item)
    {
        if (!\App::authService()->logged())
            return false;

        $item['class'] = 'visible-xs ni-invitation';

        return $item;
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onAcceptMembershipRequest(HookEvent $event)
    {
        $parent = $event->getPayload('parent');
        $poster = $event->getPayload('poster');

        if (!$parent instanceof PosterInterface or !$poster instanceof PosterInterface) return;

        \App::notificationService()->addAcceptMembershipNotification($parent, $poster);

        \App::invitationService()
            ->removeMembershipRequest($poster, $parent);

        if ($parent instanceof User)
            \App::invitationService()
                ->removeMembershipRequest($parent, $poster);
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onAfterInsertMembershipRequest(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof MembershipRequest) return;

        $poster = $payload->getPoster();
        $parent = $payload->getParent();

        if (!$poster instanceof PosterInterface or !$parent instanceof PosterInterface) return;

        \App::invitationService()
            ->addMembershipRequest($poster, $parent);
    }
}