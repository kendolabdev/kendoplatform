<?php


namespace Base\Blog\Service;

use Kendo\Application\EventHandler;
use Kendo\Content\PosterInterface;
use Kendo\Hook\HookEvent;
use Kendo\Hook\SimpleContainer;
use Kendo\View\View;

/**
 * Class EventHandlerService
 *
 * @package Base\Blog\Service
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

        if (!$profile instanceof PosterInterface)
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