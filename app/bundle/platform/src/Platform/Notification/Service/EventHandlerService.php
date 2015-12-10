<?php
namespace Platform\Notification\Service;

use Kendo\Application\EventHandler;
use Kendo\Assets\Requirejs;
use Kendo\Content\ContentInterface;
use Kendo\Content\PosterInterface;
use Kendo\Hook\HookEvent;
use Kendo\Hook\SimpleContainer;

/**
 * Class EventHandlerService
 *
 * @package Platform\Notification\Service
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

        $payload->add('base/notification', 'base/notification/main');
    }

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event) {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/notification/main'])
            ->addPrimaryBundle('base/notification/main');
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/notification/main']);
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
     * @param \Kendo\Hook\HookEvent $event
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
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onAfterDeleteContent(HookEvent $event)
    {
        $about = $event->getPayload();

        if (!$about instanceof ContentInterface) return;

        \App::notificationService()
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

        \App::notificationService()
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

        \App::notificationService()->addAcceptMembershipNotification($parent, $poster);

    }
}