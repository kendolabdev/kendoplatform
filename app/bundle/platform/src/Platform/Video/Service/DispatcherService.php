<?php

namespace Platform\Video\Service;

use Kendo\Application\EventHandler;
use Kendo\Content\PosterInterface;
use Kendo\Hook\HookEvent;
use Kendo\Hook\SimpleContainer;
use Kendo\Routing\FilterStuff;
use Kendo\Routing\RoutingManager;
use Kendo\View\View;

/**
 * Class EventHandlerService
 *
 * @package Video\Service
 */
class DispatcherService extends EventHandler
{

    /**
     * @param HookEvent $event
     */
    public function onRoutingStart(HookEvent $event)
    {
        $routing = $event->getPayload();

        if (!$routing instanceof RoutingManager) return;

        $routing->addRoute('videos', [
            'uri'      => 'videos',
            'defaults' => [
                'controller' => '\Video\Controller\HomeController',
                'action'     => 'browse-video',
            ],
        ]);

        $routing->addRoute('video_add', [
            'uri'      => 'add-video',
            'defaults' => [
                'controller' => '\Video\Controller\HomeController',
                'action'     => 'create-video',
            ],
        ]);

        $routing->addRoute('video_my', [
            'uri'      => 'my-videos',
            'defaults' => [
                'controller' => '\Video\Controller\HomeController',
                'action'     => 'my-video',
            ],
        ]);

        $routing->addRoute('video_upload', [
            'uri'      => 'upload-video',
            'defaults' => [
                'controller' => '\Video\Controller\HomeController',
                'action'     => 'upload-video',
            ],
        ]);

        $routing->addRoute('video_embed', [
            'uri'      => 'embed-video',
            'defaults' => [
                'controller' => '\Video\Controller\HomeController',
                'action'     => 'embed-video',
            ],
        ]);

        $routing->addRoute('video_view', [
            'uri'      => 'video/<id>(/<slug>)',
            'defaults' => [
                'controller' => '\Video\Controller\HomeController',
                'action'     => 'view-video',
                'slug'       => 'untilted',
            ],
        ]);

        $routing->getRoute('profile')
            ->addFilter(new FilterStuff([
                'stuff'      => 'videos',
                'controller' => '\Video\Controller\ProfileController',
                'tab'        => 'browse_video',
                'action'     => 'browse-video'
            ]));
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleStylesheet(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof SimpleContainer) return;

        $payload->add('platform/video', 'platform/video/main');
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

        $content = \App::viewHelper()->partial('platform/video/partial/composer-header-upload-video');

        $event->append($content);
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