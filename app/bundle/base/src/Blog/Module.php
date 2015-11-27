<?php

namespace Blog;

use Picaso\Routing\FilterStuff;


/**
 * Class Module
 *
 * @package Blog
 */
class Module extends \Picaso\Application\Module
{


    /**
     * @return bool
     */
    public function start()
    {
        $this->routing();
    }

    /**
     * Add class routing
     */
    private function routing()
    {

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
     * @return bool
     */
    public function complete()
    {
        // TODO: Implement bootComplete() method.


    }
}