<?php

namespace Platform\Photo\Service;

use Kendo\Hook\EventListener;
use Kendo\Assets\Requirejs;
use Kendo\Content\ContentInterface;
use Kendo\Content\PosterInterface;
use Kendo\Hook\HookEvent;
use Kendo\Hook\SimpleContainer;
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
            'btnUpdateCover'        => '\Platform\Photo\ViewHelper\ButtonUpdateCover',
            'btnUpdateCoverEditing' => '\Platform\Photo\ViewHelper\ButtonUpdateCoverEditing',
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
            'name'     => 'photos',
            'uri'      => 'photos',
            'defaults' => [
                'controller' => 'Platform\Photo\Controller\HomeController',
                'action'     => 'browse-photo',
            ],
        ]);

        $routing->add([
            'name'     => 'albums',
            'uri'      => 'albums',
            'defaults' => [
                'controller' => 'Platform\Photo\Controller\HomeController',
                'action'     => 'browse-album',
            ],
        ]);

        $routing->add([
            'name'     => 'album_my',
            'uri'      => 'my-albums',
            'defaults' => [
                'controller' => 'Platform\Photo\Controller\HomeController',
                'action'     => 'my-album',
            ],
        ]);

        $routing->add([
            'name'     => 'album_add',
            'uri'      => 'add-album',
            'defaults' => [
                'controller' => 'Platform\Photo\Controller\HomeController',
                'action'     => 'create-album',
            ],
        ]);

        $routing->add([
            'name'     => 'photo_my',
            'uri'      => 'my-photos',
            'defaults' => [
                'controller' => 'Platform\Photo\Controller\HomeController',
                'action'     => 'my-photo',
            ],
        ]);

        $routing->add([
            'name'     => 'photo_uploads',
            'uri'      => 'upload-photos',
            'defaults' => [
                'namespace'  => 'Platform\Photo',
                'controller' => 'HomeController',
                'action'     => 'upload-photo',
            ],
        ]);

        $routing->add([
            'name'     => 'photo_view',
            'uri'      => 'photo/<id>(/<slug>)',
            'defaults' => [
                'controller' => 'Platform\Photo\Controller\HomeController',
                'action'     => 'view-photo',
            ]
        ]);

        $routing->add([
            'name'     => 'photo_album_view',
            'uri'      => 'photo-album/<id>(/<slug>)',
            'defaults' => [
                'controller' => 'Platform\Photo\Controller\HomeController',
                'action'     => 'view-album',
            ]
        ]);

        $routing->add([
            'name'     => 'profile/photos',
            'replacements'=>[
                '<any>'=>'photos',
            ],
            'defaults' => [
                'controller' => 'Platform\Photo\Controller\ProfileController',
                'action'     => 'browse-photo'
            ]]);

        $routing->add([
            'name'     => 'profile/albums',
            'replacements'=>[
                '<any>'=>'albums',
            ],
            'defaults' => [
                'controller' => 'Platform\Photo\Controller\ProfileController',
                'action'     => 'browse-album'
            ]]);

        $routing->add([
            'name'     => 'profile/album',
            'replacements'=>[
                '<any>'=>'albums/<albumId>',
            ],
            'defaults' => [
                'controller' => 'Platform\Photo\Controller\ProfileController',
                'action'     => 'view-album'
            ]]);
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

        if (false == app()->auth()->logged()) return;

        if (!$payload instanceof ContentInterface) return;

        if (!$payload->viewerIsParent()) return;

        $content = app()->viewHelper()->partial('platform/photo/partial/composer-header-create-album');

        $event->prepend($content);
    }

    /**
     * @param HookEvent $event
     */
    public function onRenderActivityComposerFooter(HookEvent $event)
    {

        $payload = $event->getPayload();

        if (false == app()->auth()->logged()) return;

        if (!$payload instanceof PosterInterface) return;

        $content = app()->viewHelper()->partial('platform/photo/partial/composer-footer-add-photos');

        $event->prepend($content);
    }

    /**
     * @param $item
     *
     * @return mixed
     */
    public function onProfileMenuItemPhotos($item)
    {
        $profile = app()->registryService()->get('profile');

        if (!$profile instanceof PosterInterface)
            return false;

        if (!$profile->authorize('photo__photo_tab_exists'))
            return false;

        if (!app()->aclService()->pass($profile, 'photo__photo_tab_view'))
            return false;

        if (!app()->aclService()->authorize('photo__view'))
            return false;

        $item['href'] = $profile->toHref(['any' => 'photos']);

        return $item;
    }

    /**
     * @param $item
     *
     * @return mixed
     */
    public function onProfileMenuItemAlbums($item)
    {
        $profile = app()->registryService()->get('profile');

        if (!$profile instanceof PosterInterface)
            return false;

        if (!$profile->authorize('photo__photo_tab_exists'))
            return false;

        if (!app()->aclService()->pass($profile, 'photo__photo_tab_view'))
            return false;

        $item['href'] = $profile->toHref(['any' => 'albums']);

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
            'label' => app()->text('platform_photos'),
            'value' => app()->photoService()->getPhotoCount(),
        ];

        $stats['album'] = [
            'label' => app()->text('photo.albums'),
            'value' => app()->photoService()->getAlbumCount(),
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
            app()->photoService()
                ->setPosterAvatar($poster, $data['avatar']);
    }
}