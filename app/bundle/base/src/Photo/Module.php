<?php

namespace Photo;

use Kendo\Routing\FilterStuff;


/**
 * Class Module
 *
 * @package Photo
 */
class Module extends \Kendo\Application\Module
{

    /**
     * @return bool
     */
    public function start()
    {
        $this->routing();

        \App::viewHelper()->addClassMaps([
            'btnUpdateCover'        => '\Photo\ViewHelper\ButtonUpdateCover',
            'btnUpdateCoverEditing' => '\Photo\ViewHelper\ButtonUpdateCoverEditing',
        ]);
    }

    private function routing()
    {
        $routing = \App::routingService();

        $routing->addRoute('photos', [
            'uri'      => 'photos',
            'defaults' => [
                'controller' => '\Photo\Controller\HomeController',
                'action'     => 'browse-photo',
            ],
        ]);

        $routing->addRoute('albums', [
            'uri'      => 'albums',
            'defaults' => [
                'controller' => '\Photo\Controller\HomeController',
                'action'     => 'browse-album',
            ],
        ]);

        $routing->addRoute('album_my', [
            'uri'      => 'my-albums',
            'defaults' => [
                'controller' => '\Photo\Controller\HomeController',
                'action'     => 'my-album',
            ],
        ]);

        $routing->addRoute('album_add', [
            'uri'      => 'add-album',
            'defaults' => [
                'controller' => '\Photo\Controller\HomeController',
                'action'     => 'create-album',
            ],
        ]);

        $routing->addRoute('photo_my', [
            'uri'      => 'my-photos',
            'defaults' => [
                'controller' => '\Photo\Controller\HomeController',
                'action'     => 'my-photo',
            ],
        ]);

        $routing->addRoute('photo_uploads', [
            'uri'      => 'upload-photos',
            'defaults' => [
                'controller' => '\Photo\Controller\HomeController',
                'action'     => 'upload-photo',
            ],
        ]);

        $routing->addRoute('photo_view', [
            'uri'      => 'photo/<id>(/<slug>)',
            'defaults' => [
                'controller' => '\Photo\Controller\HomeController',
                'action'     => 'view-photo',
            ]
        ]);

        $routing->addRoute('photo_album_view', [
            'uri'      => 'photo-album/<id>(/<slug>)',
            'defaults' => [
                'controller' => '\Photo\Controller\HomeController',
                'action'     => 'view-album',
            ]
        ]);

        $routing->getRoute('profile')
            ->addFilter(new FilterStuff([
                'stuff'      => 'photos',
                'controller' => '\Photo\Controller\ProfileController',
                'action'     => 'browse-photo']))
            ->addFilter(new FilterStuff([
                'stuff'      => 'albums',
                'controller' => '\Photo\Controller\ProfileController',
                'action'     => 'browse-album']))
            ->addFilter(new FilterStuff([
                'stuff'      => 'album/<albumId>',
                'controller' => '\Photo\Controller\ProfileController',
                'action'     => 'view-album']));
    }

    /**
     * @return bool
     */
    public function complete()
    {
        // TODO: Implement bootComplete() method.
    }
}