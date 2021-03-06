<?php
namespace Platform\Invitation\Service;

use Kendo\Hook\EventListener;
use Kendo\Assets\Requirejs;
use Kendo\Content\PosterInterface;
use Kendo\Hook\HookEvent;
use Kendo\Hook\SimpleContainer;
use Kendo\Routing\RoutingManager;
use Kendo\View\ViewHelper;
use Platform\User\Model\User;

/**
 * Class EventHandlerService
 *
 * @package Platform\Invitation\Service
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
            'btnBearInvitation' => '\Platform\Invitation\ViewHelper\ButtonBearInvitation',
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
                'name'     => 'profile/requests',
                'replacements'=>[
                    '<any>'=>'requests',
                ],
                'defaults' => [
                    'controller' => 'Platform\Invitation\Controller\ProfileController',
                    'action'     => 'browse-invitation'
                ]]);

        $routing->add([
            'name'     => 'requests',
            'uri'      => 'requests',
            'defaults' => [
                'controller' => 'Platform\Invitation\Controller\HomeController',
                'action'     => 'browse-invitation',
            ],
        ]);
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleStylesheet(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof SimpleContainer) return;

        $payload->add('platform/invitation', 'platform/invitation/main');
    }

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/invitation/main'])
            ->addPrimaryBundle('platform/invitation/main');
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/invitation/main']);
    }

    /**
     * @param $item
     *
     * @return bool
     */
    public function onProfileMenuItemRequests($item)
    {
        $profile = app()->registryService()->get('profile');

        if (!$profile instanceof PosterInterface) return false;

        if (!$profile->viewerIsParent()) return false;

        $item['href'] = $profile->toHref(['any' => 'requests']);

        return $item;
    }

    /**
     * @param $item
     *
     * @return bool
     */
    public function onMenuMainInvitations($item)
    {
        if (!app()->auth()->logged())
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

        app()->notificationService()->addAcceptMembershipNotification($parent, $poster);

        app()->invitationService()
            ->removeMembershipRequest($poster, $parent);

        if ($parent instanceof User)
            app()->invitationService()
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

        app()->invitationService()
            ->addMembershipRequest($poster, $parent);
    }
}