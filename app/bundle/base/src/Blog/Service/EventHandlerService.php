<?php


namespace Blog\Service;

use Picaso\Application\EventHandler;
use Picaso\Content\Poster;
use Picaso\Hook\HookEvent;
use Picaso\Hook\SimpleContainer;
use Picaso\View\View;

/**
 * Class EventHandlerService
 *
 * @package Blog\Service
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

        $payload->add('base/blog', 'base/blog/main');
    }

    /**
     * @param $item
     *
     * @return mixed
     */
    public function onProfileMenuItemBlogs($item)
    {
        $profile = \App::registryService()->get('profile');

        if (!$profile instanceof Poster)
            return false;

        if (!$profile->authorize('blog__blog_tab_exists'))
            return false;

        if (!\App::aclService()->pass($profile, 'blog__blog_tab_view'))
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
            'value' => \App::blogService()->getActiveBlogCount(),
        ];

        $payload->__set('stats', $stats);
    }
}