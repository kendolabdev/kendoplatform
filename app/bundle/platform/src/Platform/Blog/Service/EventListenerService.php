<?php


namespace Platform\Blog\Service;

use Kendo\Hook\EventListener;
use Kendo\Content\PosterInterface;
use Kendo\Hook\HookEvent;
use Kendo\Hook\SimpleContainer;
use Kendo\Routing\RoutingManager;
use Kendo\View\View;

/**
 * Class EventHandlerService
 *
 * @package Base\Blog\Service
 */
class EventListenerService extends EventListener
{

    public function onRoutingStart(HookEvent $event)
    {

        $routing = $event->getPayload();

        if (!$routing instanceof RoutingManager) return;

        $routing->add([
            'name'     => 'blog_view',
            'uri'      => 'blog-post(/<id>)',
            'defaults' => [
                'controller' => 'Platform\Blog\Controller\HomeController',
                'action'     => 'view-blog',
            ]
        ]);

        $routing->add([
            'name'     => 'blog_cmd',
            'uri'      => 'blog/<id>/<action>',
            'defaults' => [
                'controller' => 'Platform\Blog\Controller\HomeController',
            ]
        ]);

        $routing->add([
                'name'     => 'blogs',
                'uri'      => 'blogs(/<action>)',
                'defaults' => [
                    'controller' => 'Platform\Blog\Controller\HomeController',
                    'action'     => 'browse-blog',
                ]]
        );

        $routing->add([
                'name'     => 'blog_my',
                'uri'      => 'my-blogs',
                'defaults' => [
                    'controller' => 'Platform\Blog\Controller\HomeController',
                    'action'     => 'my-blog',
                ]]
        );

        $routing->add([
                'name'     => 'blog_add',
                'uri'      => 'add-blogs',
                'defaults' => [
                    'controller' => 'Platform\Blog\Controller\HomeController',
                    'action'     => 'create-blog',
                ]]
        );

        $routing->add([
                'name'     => 'blog_import',
                'uri'      => 'import-blogs',
                'defaults' => [
                    'controller' => 'Platform\Blog\Controller\HomeController',
                    'action'     => 'import-blog',
                ]]
        );

        $routing->add([
            'name'         => 'profile/blogs',
            'replacements' => [
                '<any>' => 'blogs',
            ],
            'defaults'     => [
                'controller' => 'Platform\Blog\Controller\ProfileController',
                'action'     => 'browse-blog'
            ]]);
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleStylesheet(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof SimpleContainer) return;

        $payload->add('platform/blog', 'platform/blog/main');
    }

    /**
     * @param $item
     *
     * @return mixed
     */
    public function onProfileMenuItemBlogs($item)
    {
        $profile = app()->registryService()->get('profile');

        if (!$profile instanceof PosterInterface)
            return false;

        if (!$profile->authorize('blog__blog_tab_exists'))
            return false;

        if (!app()->aclService()->pass($profile, 'blog__blog_tab_view'))
            return false;

        $item['href'] = $profile->toHref(['any' => 'blogs']);

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
            'label' => app()->text('blog.blogs'),
            'value' => app()->blogService()->getActiveBlogCount(),
        ];

        $payload->__set('stats', $stats);
    }
}