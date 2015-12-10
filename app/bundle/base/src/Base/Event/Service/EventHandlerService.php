<?php
namespace Base\Event\Service;

use Kendo\Application\EventHandler;
use Kendo\Assets\Requirejs;
use Kendo\Hook\HookEvent;
use Kendo\Hook\SimpleContainer;
use Kendo\View\View;
use Platform\User\Model\User;

/**
 * Class EventHandlerService
 *
 * @package Event\Service
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

        $payload->add('base/event', 'base/event/main');
    }

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event) {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/event/main'])
            ->addPrimaryBundle('base/event/main');
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/event/main']);
    }

    /**
     * @param $item
     *
     * @return mixed
     */
    public function onProfileMenuItemEvents($item)
    {
        $profile = \App::registryService()->get('profile');

        if (!$profile instanceof User)
            return false;

        if (!$profile->authorize('event__event_tab_exists'))
            return false;


        if (!\App::aclService()->pass($profile, 'event__event_tab_view'))
            return false;

        $item['href'] = $profile->toHref(['stuff' => 'events']);

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

        $stats['event'] = [
            'label' => \App::text('event.events'),
            'value' => \App::eventService()->getEventCount(),
        ];

        $payload->__set('stats', $stats);
    }
}