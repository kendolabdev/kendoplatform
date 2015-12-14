<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/12/15
 * Time: 11:06 PM
 */

namespace Kendo\Routing;


use Kendo\Request\HttpRequest;

class RoutingManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function routingMatchProvider()
    {
        return [
            ['/', [], '\Platform\Core\Controller\HomeController', 'index'],
            ['/members', [], '\Platform\User\Controller\HomeController', 'browse-user'],
            ['/login', [], '\Platform\User\Controller\AuthController', 'login'],
            ['/logout', [], '\Platform\User\Controller\AuthController', 'logout'],
            ['/forgot-password', [], '\Platform\User\Controller\AuthController', 'forgot-password'],
        ];
    }

    /**
     * @dataProvider  routingMatchProvider
     *
     * @param $uri
     * @param $controllerName
     * @param $actionName
     * @param $params
     */
    public function testRoutingMatch($uri, $params, $controllerName, $actionName)
    {
        $request = new HttpRequest($uri);

        $routing = \App::instance()->make('routing');

//        var_dump($routing);

//        ->match($request);
//
//
//        $this->assertEquals($controllerName, $request->getControllerName());
//        $this->assertEquals($actionName, $request->getActionName());

    }
}
