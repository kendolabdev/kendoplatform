<?php
namespace Event\Service;

use Picaso\Hook\HookEvent;
use Picaso\Hook\SimpleContainer;
use Picaso\View\View;
use User\Model\User;

/**
 * Class EventHandlerService
 *
 * @package Event\Service
 */
class EventHandlerService extends \Picaso\Application\EventHandler
{

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof SimpleContainer) return;

        $payload->add('event/main', 'base/event/main');
    }

    /**
     * @param $item
     *
     * @return mixed
     */
    public function onProfileMenuItemEvents($item)
    {
        $profile = \App::registry()->get('profile');

        if (!$profile instanceof User)
            return false;

        if (!$profile->authorize('event__event_tab_exists'))
            return false;


        if (!\App::acl()->pass($profile, 'event__event_tab_view'))
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
            'value' => \App::service('event')->getEventCount(),
        ];

        $payload->__set('stats', $stats);
    }
}