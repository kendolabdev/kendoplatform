<?php
namespace Like;

use Picaso\Routing\FilterStuff;

/**
 * Class Module
 *
 * @package Like
 */
class Module extends \Picaso\Application\Module
{
    public function start()
    {

        \App::viewHelper()
            ->addClassMaps([
                'lnLike'         => '\Like\ViewHelper\LinkLike',
                'lnLikeComment'  => '\Like\ViewHelper\LinkLikeComment',
                'listLikeSample' => '\Like\ViewHelper\ListLikeSample',
            ]);

        $routing = \App::routing();

        $routing->getRoute('profile')
            ->addFilter(new FilterStuff([
                'stuff'      => 'likes',
                'controller' => '\Like\Controller\ProfileController',
                'action'     => 'browse-like']));
    }
}