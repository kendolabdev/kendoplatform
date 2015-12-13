<?php
namespace Platform\Notification\Service;

use Kendo\Event\EventListener;
use Kendo\Assets\Requirejs;
use Kendo\Content\ContentInterface;
use Kendo\Content\PosterInterface;
use Kendo\Event\HookEvent;
use Kendo\Event\SimpleContainer;
use Kendo\Routing\FilterStuff;
use Kendo\Routing\RoutingManager;
use Kendo\View\ViewHelper;

/**
 * Class EventHandlerService
 *
 * @package Platform\Notification\Service
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
            'btnBearNotification' => '\Notification\ViewHelper\ButtonBearNotification',
        ]);
    }

    /**
     * @param HookEvent $event
     */
    public function onRoutingStart(HookEvent $event)
    {
        $routing = $event->getPayload();

        if (!$routing instanceof RoutingManager) return;

        $routing->getRoute('profile')
            ->addFilter(new FilterStuff([
                'stuff'      => 'notifications',
                'controller' => '\Notification\Controller\ProfileController',
                'action'     => 'browse-notification']));

        $routing->addRoute('notifications', [
            'uri'      => 'notifications',
            'defaults' => [
                'controller' => '\Notification\Controller\HomeController',
                'action'     => 'browse-notification',
            ],
        ]);
    }

    /**
     * @param \Kendo\Event\HookEvent $event
     */
    public function onBeforeBuildBundleStylesheet(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof SimpleContainer) return;

        $payload->add('platform/notification', 'platform/notification/main');
    }

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/notification/main'])
            ->addPrimaryBundle('platform/notification/main');
    }

    /**
     * @param \Kendo\Event\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/notification/main']);
    }

    /**
     * @param $item
     *
     * @return bool
     */
    public function onMenuMainNotifications($item)
    {
        if (!\App::authService()->logged())
            return false;

        $item['class'] = 'visible-xs ni-notification';

        return $item;
    }

    /**
     * @param $item
     *
     * @return bool
     */
    public function onProfileMenuItemNotifications($item)
    {
        $profile = \App::registryService()->get('profile');

        if (!$profile instanceof PosterInterface) return false;

        if (!$profile->viewerIsParent()) return false;

        $item['href'] = $profile->toHref(['stuff' => 'notifications']);

        return $item;
    }


    /**
     * @param \Kendo\Event\HookEvent $event
     */
    public function onAfterInsertContent(HookEvent $event)
    {
        $about = $event->getPayload();

        if (!$about instanceof ContentInterface) return;

        $poster = $about->getPoster();

        \App::notificationService()
            ->subscribe($poster, $about);
    }


    /**
     * @param \Kendo\Event\HookEvent $event
     */
    public function onAfterDeleteContent(HookEvent $event)
    {
        $about = $event->getPayload();

        if (!$about instanceof ContentInterface) return;

        \App::notificationService()
            ->removeAllByAbout($about);
    }


    /**
     * @param \Kendo\Event\HookEvent $event
     */
    public function onAfterInsertPoster(HookEvent $event)
    {
        /**
         * TODO: before insert poster get notification logic
         */
    }


    /**
     * @param \Kendo\Event\HookEvent $event
     */
    public function onAfterDeletePoster(HookEvent $event)
    {
        $poster = $event->getPayload();

        if (!$poster instanceof PosterInterface) return;

        \App::notificationService()
            ->removeAllByPoster($poster);
    }

    /**
     * @param \Kendo\Event\HookEvent $event
     */
    public function onAcceptMembershipRequest(HookEvent $event)
    {
        $parent = $event->getPayload('parent');
        $poster = $event->getPayload('poster');

        if (!$parent instanceof PosterInterface or !$poster instanceof PosterInterface) return;

        \App::notificationService()->addAcceptMembershipNotification($parent, $poster);

    }
}