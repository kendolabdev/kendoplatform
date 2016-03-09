<?php
namespace Platform\Notification\Service;

use Kendo\Hook\EventListener;
use Kendo\Assets\Requirejs;
use Kendo\Content\ContentInterface;
use Kendo\Content\PosterInterface;
use Kendo\Hook\HookEvent;
use Kendo\Hook\SimpleContainer;
use Kendo\Http\FilterStuff;
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
            'btnBearNotification' => '\Platform\Notification\ViewHelper\ButtonBearNotification',
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
            'name'     => 'profile/notifications',
            'replacements'=>[
                '<any>'=>'notifications',
            ],
            'defaults' => [
                'controller' => 'Platform\Notification\Controller\ProfileController',
                'action'     => 'browse-notification'
            ]]);

        $routing->add([
            'name'     => 'notifications',
            'uri'      => 'notifications',
            'defaults' => [
                'controller' => 'Platform\Notification\Controller\HomeController',
                'action'     => 'browse-notification',
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
     * @param \Kendo\Hook\HookEvent $event
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
        if (!app()->auth()->logged())
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
        $profile = app()->registryService()->get('profile');

        if (!$profile instanceof PosterInterface) return false;

        if (!$profile->viewerIsParent()) return false;

        $item['href'] = $profile->toHref(['any' => 'notifications']);

        return $item;
    }


    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onAfterInsertContent(HookEvent $event)
    {
        $about = $event->getPayload();

        if (!$about instanceof ContentInterface) return;

        $poster = $about->getPoster();

        app()->notificationService()
            ->subscribe($poster, $about);
    }


    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onAfterDeleteContent(HookEvent $event)
    {
        $about = $event->getPayload();

        if (!$about instanceof ContentInterface) return;

        app()->notificationService()
            ->removeAllByAbout($about);
    }


    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onAfterInsertPoster(HookEvent $event)
    {
        /**
         * TODO: before insert poster get notification logic
         */
    }


    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onAfterDeletePoster(HookEvent $event)
    {
        $poster = $event->getPayload();

        if (!$poster instanceof PosterInterface) return;

        app()->notificationService()
            ->removeAllByPoster($poster);
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

    }
}