<?php

namespace Platform\Photo\Service;

use Kendo\Application\EventHandler;
use Kendo\Assets\Requirejs;
use Kendo\Content\ContentInterface;
use Kendo\Content\PosterInterface;
use Kendo\Hook\HookEvent;
use Kendo\Hook\SimpleContainer;
use Kendo\View\View;

/**
 * Class EventHandlerService
 *
 * @package Platform\Photo\Service
 */
class EventHandlerService extends EventHandler {
    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleStylesheet(HookEvent $event) {
        $payload = $event->getPayload();

        if (!$payload instanceof SimpleContainer) return;

        $payload->add('base/photo', 'base/photo/main');
    }

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event) {

        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/photo/main'])
            ->addPrimaryBundle('base/photo/main');
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event) {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/photo/main']);
    }


    /**
     * @param HookEvent $event
     */
    public function onRenderActivityComposerHeader(HookEvent $event) {

        $payload = $event->getPayload();

        if (false == \App::authService()->logged()) return;

        if (!$payload instanceof ContentInterface) return;

        if (!$payload->viewerIsParent()) return;

        $content = \App::viewHelper()->partial('base/photo/partial/composer-header-create-album');

        $event->prepend($content);
    }

    /**
     * @param HookEvent $event
     */
    public function onRenderActivityComposerFooter(HookEvent $event) {

        $payload = $event->getPayload();

        if (false == \App::authService()->logged()) return;

        if (!$payload instanceof PosterInterface) return;

        $content = \App::viewHelper()->partial('base/photo/partial/composer-footer-add-photos');

        $event->prepend($content);
    }

    /**
     * @param $item
     *
     * @return mixed
     */
    public function onProfileMenuItemPhotos($item) {
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
    public function onProfileMenuItemAlbums($item) {
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
    public function onAdminStatisticBlockRender(HookEvent $event) {
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
    public function onCompleteCreatePoster(HookEvent $event) {
        $poster = $event->getPayload('poster');

        $data = $event->getPayload('data', []);

        if (!empty($data['avatar']))
            \App::photoService()
                ->setPosterAvatar($poster, $data['avatar']);
    }
}