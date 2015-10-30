<?php

namespace Feed;

use Picaso\Routing\FilterStuff;


/**
 * Class Module
 *
 * @package Feed
 */
class Module extends \Picaso\Application\Module
{

    /**
     * @return bool
     */
    public function start()
    {
        $this->routing();

        \App::viewHelper()->addClassMaps([
            'decorateStory' => '\Feed\ViewHelper\DecorateStory',
        ]);
    }

    private function routing()
    {
        $routing = \App::routing();

        $routing->addRoute('hashtag', [
            'uri'      => 'hashtag',
            'defaults' => [
                'controller' => '\Feed\Controller\HomeController',
                'action'     => 'hashtag',
            ],
        ]);

        $routing->addRoute('feed_view', [
            'uri'      => 'feed/<id>',
            'uri_expr' => [
                'id' => '\d+',
            ],
            'defaults' => [
                'controller' => '\Feed\Controller\HomeController',
                'action'     => 'view-feed',
            ]
        ]);

        $routing->getRoute('profile')
            ->addFilter(new FilterStuff([
                'stuff'      => 'timeline',
                'controller' => '\Feed\Controller\ProfileController',
                'action'     => 'timeline']));
    }

    /**
     * @return bool
     */
    public function complete()
    {

    }
}