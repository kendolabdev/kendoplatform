<?php
namespace Follow;

use Picaso\Routing\FilterStuff;

/**
 * Class Module
 *
 * @package Follow
 */
class Module extends \Picaso\Application\Module
{
    public function start()
    {
        \App::viewHelper()
            ->addClassMaps([
                'btnFollow' => '\Follow\ViewHelper\ButtonFollow',
            ]);

        $routing = \App::routingService();

        $routing->getRoute('profile')
            ->addFilter(new FilterStuff([
                'stuff'      => 'followers',
                'controller' => '\Follow\Controller\ProfileController',
                'action'     => 'browse-follower']))
            ->addFilter(new FilterStuff([
                'stuff'      => 'following',
                'controller' => '\Follow\Controller\ProfileController',
                'action'     => 'browse-following']));
    }
}