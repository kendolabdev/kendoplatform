<?php

namespace Platform\Photo\Service;

use Kendo\Hook\EventListener;
use Kendo\Assets\Requirejs;
use Kendo\Content\ContentInterface;
use Kendo\Content\PosterInterface;
use Kendo\Hook\HookEvent;
use Kendo\Hook\SimpleContainer;
use Kendo\Routing\FilterStuff;
use Kendo\Routing\RoutingManager;
use Kendo\View\View;
use Kendo\View\ViewHelper;

/**
 * Class EventHandlerService
 *
 * @package Platform\Photo\Service
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
            'btnUpdateCover'        => '\Photo\ViewHelper\ButtonUpdateCover',
            'btnUpdateCoverEditing' => '\Photo\ViewHelper\ButtonUpdateCoverEditing',
        ]);
    }

    /**
     * @param HookEvent $event
     */
    public function onRoutingStart(HookEvent $event)
    {
        $routing = $event->getPayload();

        if (!$routing instanceof RoutingManager) return;

        $routing->addRoute('photos', [
            'uri'      => 'photos',
            'defaults' => [
                'controller' => '\Photo\Controller\HomeController',
                'action'     => 'browse-photo',
            ],
        ]);

        $routing->addRoute('albums', [
            'uri'      => 'albums',
            'defaults' => [
                'controller' => '\Photo\Controller\HomeController',
                'action'     => 'browse-album',
            ],
        ]);

        $routing->addRoute('album_my', [
            'uri'      => 'my-albums',
            'defaults' => [
                'controller' => '\Photo\Controller\HomeController',
                'action'     => 'my-album',
            ],
        ]);

        $routing->addRoute('album_add', [
            'uri'      => 'add-album',
            'defaults' => [
                'controller' => '\Photo\Controller\HomeController',
                'action'     => 'create-album',
            ],
        ]);

        $routing->addRoute('photo_my', [
            'uri'      => 'my-photos',
            'defaults' => [
                'controller' => '\Photo\Controller\HomeController',
                'action'     => 'my-photo',
            ],
        ]);

        $routing->addRoute('photo_uploads', [
            'uri'      => 'upload-photos',
            'defaults' => [
                'controller' => '\Photo\Controller\HomeController',
                'action'     => 'upload-photo',
            ],
        ]);

        $routing->addRoute('photo_view', [
            'uri'      => 'photo/<id>(/<slug>)',
            'defaults' => [
                'controller' => '\Photo\Controller\HomeController',
                'action'     => 'view-photo',
            ]
        ]);

        $routing->addRoute('photo_album_view', [
            'uri'      => 'photo-album/<id>(/<slug>)',
            'defaults' => [
                'controller' => '\Photo\Controller\HomeController',
                'action'     => 'view-album',
            ]
        ]);

        $routing->getRoute('profile')
            ->addFilter(new FilterStuff([
                'stuff'      => 'photos',
                'controller' => '\Photo\Controller\ProfileController',
                'action'     => 'browse-photo']))
            ->addFilter(new FilterStuff([
                'stuff'      => 'albums',
                'controller' => '\Photo\Controller\ProfileController',
                'action'     => 'browse-album']))
            ->addFilter(new FilterStuff([
                'stuff'      => 'album/<albumId>',
                'controller' => '\Photo\Controller\ProfileController',
                'action'     => 'view-album']));
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleStylesheet(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof SimpleContainer) return;

        $payload->add('platform/photo', 'platform/photo/main');
    }

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event)
    {

        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/photo/main'])
            ->addPrimaryBundle('platform/photo/main');
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/photo/main']);
    }


    /**
     * @param HookEvent $event
     */
    public function onRenderActivityComposerHeader(HookEvent $event)
    {

        $payload = $event->getPayload();

        if (false == \App::authService()->logged()) return;

        if (!$payload instanceof ContentInterface) return;

        if (!$payload->viewerIsParent()) return;

        $content = \App::viewHelper()->partial('platform/photo/partial/composer-header-create-album');

        $event->prepend($content);
    }

    /**
     * @param HookEvent $event
     */
    public function onRenderActivityComposerFooter(HookEvent $event)
    {

        $payload = $event->getPayload();

        if (false == \App::authService()->logged()) return;

        if (!$payload instanceof PosterInterface) return;

        $content = \App::viewHelper()->partial('platform/photo/partial/composer-footer-add-photos');

        $event->prepend($content);
    }

    /**
     * @param $item
     *
     * @return mixed
     */
    public function onProfileMenuItemPhotos($item)
    {
        $profile = \App::registryService()->get('profile');

        if (!$profile instanceof PosterInterface)
            return false;

        if (!$profile->authorize('photo__photo_tab_exists'))
            return false;

        if (!\App::aclService()->pass($profile, 'photo__photo_tab_view'))
            return false;

        if (!\App::aclService()->authorize('photo__view'))
            return false;

        $item['href'] = $profile->toHref(['stuff' => 'photos']);

        return $item;
    }

    /**
     * @param $item
     *
     * @return mixed
     */
    public function onProfileMenuItemAlbums($item)
    {
        $profile = \App::registryService()->get('profile');

        if (!$profile instanceof PosterInterface)
            return false;

        if (!$profile->authorize('photo__photo_tab_exists'))
            return false;

        if (!\App::aclService()->pass($profile, 'photo__photo_tab_view'))
            return false;

        $item['href'] = $profile->toHref(['stuff' => 'albums']);

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

        $stats['photo'] = [
            'label' => \App::text('photo.photos'),
            'value' => \App::photoService()->getPhotoCount(),
        ];

        $stats['album'] = [
            'label' => \App::text('photo.albums'),
            'value' => \App::photoService()->getAlbumCount(),
        ];

        $payload->__set('stats', $stats);
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onCompleteCreatePoster(HookEvent $event)
    {
        $poster = $event->getPayload('poster');

        $data = $event->getPayload('data', []);

        if (!empty($data['avatar']))
            \App::photoService()
                ->setPosterAvatar($poster, $data['avatar']);
    }
}