<?php

namespace Video\Service;

use Picaso\Application\EventHandler;
use Picaso\Content\Poster;
use Picaso\Hook\HookEvent;
use Picaso\View\View;

/**
 * Class EventHandlerService
 *
 * @package Video\Service
 */
class EventHandlerService extends EventHandler
{
    /**
     * @param HookEvent $event
     */
    public function onRenderActivityComposerHeader(HookEvent $event)
    {

        $payload = $event->getPayload();

        if (false == \App::auth()->logged()) return;

        if (!$payload instanceof Poster) return;

        if (!\App::acl()->pass($payload, 'video__create')) return;

        $content = \App::viewHelper()->partial('base/video/partial/composer-header-upload-video');

        $event->addResponse($content);
    }

    /**
     * @param $item
     *
     * @return mixed
     */
    public function onProfileMenuItemVideos($item)
    {
        $profile = \App::registry()->get('profile');

        if (!$profile instanceof Poster)
            return false;

        if (!$profile->authorize('video__video_tab_exists'))
            return false;

        if (!\App::acl()->pass($profile, 'video__video_tab_view'))
            return false;

        $item['href'] = $profile->toHref(['stuff' => 'videos']);

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

        $stats['video'] = [
            'label' => \App::text('video.videos'),
            'value' => \App::service('video')->getActiveVideoCount(),
        ];

        $payload->__set('stats', $stats);
    }

}