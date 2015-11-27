<?php

namespace Photo\Service;

use Picaso\Application\EventHandler;
use Picaso\Content\Content;
use Picaso\Content\Poster;
use Picaso\Hook\HookEvent;
use Picaso\Hook\SimpleContainer;
use Picaso\View\View;

/**
 * Class EventHandlerService
 *
 * @package Photo\Service
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

        $payload->add('base/photo', 'base/photo');
    }


    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof SimpleContainer) return;

        $payload->add('photo/main', 'base/photo/main');
    }


    /**
     * @param HookEvent $event
     */
    public function onRenderActivityComposerHeader(HookEvent $event)
    {

        $payload = $event->getPayload();

        if (false == \App::authService()->logged()) return;

        if (!$payload instanceof Content) return;

        if (!$payload->viewerIsParent()) return;

        $content = \App::viewHelper()->partial('base/photo/partial/composer-header-create-album');

        $event->addResponse($content, false);
    }

    /**
     * @param HookEvent $event
     */
    public function onRenderActivityComposerFooter(HookEvent $event)
    {

        $payload = $event->getPayload();

        if (false == \App::authService()->logged()) return;

        if (!$payload instanceof Poster) return;

        $content = \App::viewHelper()->partial('base/photo/partial/composer-footer-add-photos');

        $event->addResponse($content, true);
    }

    /**
     * @param $item
     *
     * @return mixed
     */
    public function onProfileMenuItemPhotos($item)
    {
        $profile = \App::registryService()->get('profile');

        if (!$profile instanceof Poster)
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

        if (!$profile instanceof Poster)
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
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onCompleteCreatePoster(HookEvent $event)
    {
        $poster = $event->get('poster');

        $data = $event->get('data', []);

        if (!empty($data['avatar']))
            \App::photoService()
                ->setPosterAvatar($poster, $data['avatar']);
    }
}