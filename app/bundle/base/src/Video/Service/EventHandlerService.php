<?php

namespace Video\Service;

use Picaso\Application\EventHandler;
use Picaso\Content\Poster;
use Picaso\Hook\HookEvent;
use Picaso\Hook\SimpleContainer;
use Picaso\View\View;

/**
 * Class EventHandlerService
 *
 * @package Video\Service
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

        $payload->add('base/video', 'base/video/main');
    }

    /**
     * @param HookEvent $event
     */
    public function onRenderActivityComposerHeader(HookEvent $event)
    {

        $payload = $event->getPayload();

        if (false == \App::authService()->logged()) return;

        if (!$payload instanceof Poster) return;

        if (!\App::aclService()->pass($payload, 'video__create')) return;

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
        $profile = \App::registryService()->get('profile');

        if (!$profile instanceof Poster)
            return false;

        if (!$profile->authorize('video__video_tab_exists'))
            return false;

        if (!\App::aclService()->pass($profile, 'video__video_tab_view'))
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
            'value' => \App::videoService()->getActiveVideoCount(),
        ];

        $payload->__set('stats', $stats);
    }

}