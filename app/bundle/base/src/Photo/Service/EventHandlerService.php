<?php

namespace Photo\Service;

use Picaso\Application\EventHandler;
use Picaso\Content\Content;
use Picaso\Content\Poster;
use Picaso\Hook\HookEvent;
use Picaso\View\View;

/**
 * Class EventHandlerService
 *
 * @package Photo\Service
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

        if (false == \App::auth()->logged()) return;

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
        $profile = \App::registry()->get('profile');

        if (!$profile instanceof Poster)
            return false;

        if (!$profile->authorize('photo__photo_tab_exists'))
            return false;

        if (!\App::acl()->pass($profile, 'photo__photo_tab_view'))
            return false;

        if (!\App::acl()->authorize('photo__view'))
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
        $profile = \App::registry()->get('profile');

        if (!$profile instanceof Poster)
            return false;

        if (!$profile->authorize('photo__photo_tab_exists'))
            return false;

        if (!\App::acl()->pass($profile, 'photo__photo_tab_view'))
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
            'value' => \App::photo()->getPhotoCount(),
        ];

        $stats['album'] = [
            'label' => \App::text('photo.albums'),
            'value' => \App::photo()->getAlbumCount(),
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
            \App::photo()
                ->setPosterAvatar($poster, $data['avatar']);
    }
}