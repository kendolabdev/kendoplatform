<?php
namespace Platform\Follow;

use Kendo\Routing\FilterStuff;

/**
 * Class Module
 *
 * @package Follow
 */
class Module extends \Kendo\Application\Module
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