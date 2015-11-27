<?php

namespace Video;

use Picaso\Routing\FilterStuff;


/**
 * Class Module
 *
 * @package Video
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

    private function routing()
    {
        $routing = \App::routingService();

        $routing->addRoute('videos', [
            'uri'      => 'videos',
            'defaults' => [
                'controller' => '\Video\Controller\HomeController',
                'action'     => 'browse-video',
            ],
        ]);

        $routing->addRoute('video_add', [
            'uri'      => 'add-video',
            'defaults' => [
                'controller' => '\Video\Controller\HomeController',
                'action'     => 'create-video',
            ],
        ]);

        $routing->addRoute('video_my', [
            'uri'      => 'my-videos',
            'defaults' => [
                'controller' => '\Video\Controller\HomeController',
                'action'     => 'my-video',
            ],
        ]);

        $routing->addRoute('video_upload', [
            'uri'      => 'upload-video',
            'defaults' => [
                'controller' => '\Video\Controller\HomeController',
                'action'     => 'upload-video',
            ],
        ]);

        $routing->addRoute('video_embed', [
            'uri'      => 'embed-video',
            'defaults' => [
                'controller' => '\Video\Controller\HomeController',
                'action'     => 'embed-video',
            ],
        ]);

        $routing->addRoute('video_view', [
            'uri'      => 'video/<id>(/<slug>)',
            'defaults' => [
                'controller' => '\Video\Controller\HomeController',
                'action'     => 'view-video',
                'slug'       => 'untilted',
            ],
        ]);

        $routing->getRoute('profile')
            ->addFilter(new FilterStuff([
                'stuff'      => 'videos',
                'controller' => '\Video\Controller\ProfileController',
                'tab'        => 'browse_video',
                'action'     => 'browse-video'
            ]));


    }

    /**
     * @return bool
     */
    public function complete()
    {
        // TODO: Implement bootComplete() method.
    }
}