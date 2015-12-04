<?php

namespace Page\Service;

use Picaso\Application\EventHandler;
use Picaso\Hook\HookEvent;
use Picaso\Hook\SimpleContainer;
use Picaso\View\View;
use User\Model\User;

/**
 * Class EventHandlerService
 *
 * @package Page\Service
 */
class EventHandlerService extends EventHandler
{

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleStylesheet(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof SimpleContainer) return;

        $payload->add('base/page', 'base/page/main');
    }

    /**
     * @param $item
     *
     * @return mixed
     */
    public function onProfileMenuItemPages($item)
    {
        $profile = \App::registryService()->get('profile');

        if (!$profile instanceof User)
            return false;

        if (!$profile->authorize('page__page_tab_exists'))
            return false;

        if (!\App::aclService()->pass($profile, 'page__page_tab_view'))
            return false;

        $item['href'] = $profile->toHref(['stuff' => 'pages']);

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

        $stats['page'] = [
            'label' => \App::text('page.pages'),
            'value' => \App::pageService()->getActivePageCount(),
        ];

        $payload->__set('stats', $stats);
    }
}