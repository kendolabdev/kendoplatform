<?php


namespace Blog\Service;

use Picaso\Application\EventHandler;
use Picaso\Content\Poster;
use Picaso\Hook\HookEvent;
use Picaso\View\View;

/**
 * Class EventHandlerService
 *
 * @package Blog\Service
 */
class EventHandlerService extends EventHandler
{

    /**
     * @param $item
     *
     * @return mixed
     */
    public function onProfileMenuItemBlogs($item)
    {
        $profile = \App::registry()->get('profile');

        if (!$profile instanceof Poster)
            return false;

        if (!$profile->authorize('blog__blog_tab_exists'))
            return false;

        if (!\App::acl()->pass($profile, 'blog__blog_tab_view'))
            return false;

        $item['href'] = $profile->toHref(['stuff' => 'blogs']);

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

        $stats['blog'] = [
            'label' => \App::text('blog.blogs'),
            'value' => \App::service('blog')->getActiveBlogCount(),
        ];

        $payload->__set('stats', $stats);
    }
}