<?php

namespace Video\Service;

use Kendo\Application\EventHandler;
use Kendo\Content\PosterInterface;
use Kendo\Hook\HookEvent;
use Kendo\Hook\SimpleContainer;
use Kendo\View\View;

/**
 * Class EventHandlerService
 *
 * @package Video\Service
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

        $payload->add('base/video', 'base/video/main');
    }

    /**
     * @param HookEvent $event
     */
    public function onRenderActivityComposerHeader(HookEvent $event)
    {

        $payload = $event->getPayload();

        if (false == \App::authService()->logged()) return;

        if (!$payload instanceof PosterInterface) return;

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

        if (!$profile instanceof PosterInterface)
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