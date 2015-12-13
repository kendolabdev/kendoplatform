<?php


namespace Platform\Blog\Service;

use Kendo\Event\EventListener;
use Kendo\Content\PosterInterface;
use Kendo\Event\HookEvent;
use Kendo\Event\SimpleContainer;
use Kendo\Routing\FilterStuff;
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

        $routing = \App::routingService();

        $routing->addRoute('blog_view', [
            'uri'      => 'blog-post(/<id>)',
            'defaults' => [
                'controller' => '\Blog\Controller\HomeController',
                'action'     => 'view-blog',
            ]
        ]);

        $routing->addRoute('blog_cmd', [
            'uri'      => 'blog/<id>/<action>',
            'defaults' => [
                'controller' => '\Blog\Controller\HomeController',
            ]
        ]);

        $routing->addRoute('blogs', [
                'uri'      => 'blogs(/<action>)',
                'defaults' => [
                    'controller' => '\Blog\Controller\HomeController',
                    'action'     => 'browse-blog',
                ]]
        );

        $routing->addRoute('blog_my', [
                'uri'      => 'my-blogs',
                'defaults' => [
                    'controller' => '\Blog\Controller\HomeController',
                    'action'     => 'my-blog',
                ]]
        );

        $routing->addRoute('blog_add', [
                'uri'      => 'add-blogs',
                'defaults' => [
                    'controller' => '\Blog\Controller\HomeController',
                    'action'     => 'create-blog',
                ]]
        );

        $routing->addRoute('blog_import', [
                'uri'      => 'import-blogs',
                'defaults' => [
                    'controller' => '\Blog\Controller\HomeController',
                    'action'     => 'import-blog',
                ]]
        );

        $routing->getRoute('profile')
            ->addFilter(new FilterStuff([
                'stuff'      => 'blogs',
                'controller' => '\Blog\Controller\ProfileController',
                'action'     => 'browse-blog']));
    }

    /**
     * @param \Kendo\Event\HookEvent $event
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