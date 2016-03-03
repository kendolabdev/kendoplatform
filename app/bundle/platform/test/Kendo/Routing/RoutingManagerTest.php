<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/12/15
 * Time: 11:06 PM
 */

namespace Kendo\Http;

use Kendo\Http\HttpRequest;

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
            ['/qHeaney', [], '\Platform\User\Controller\ProfileController', 'index'],
            ['/qHeaney/blogs', [], '\Platform\Blog\Controller\ProfileController', 'browse-blog'],
            ['/qHeaney/friends', [], '\Platform\User\Controller\ProfileController', 'browse-member'],
            ['/qHeaney/videos', [], '\Platform\Video\Controller\ProfileController', 'browse-video'],
            ['/login', [], '\Platform\User\Controller\AuthController', 'login'],
            ['/logout', [], '\Platform\User\Controller\AuthController', 'logout'],
            ['/forgot-password', [], '\Platform\User\Controller\AuthController', 'forgot-password'],
            ['/ajax/user/manage', [], '\Platform\Core\Controller\ErrorController', 'notfound'],
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

        \App::routing()->resolve($request);

        $this->assertEquals($controllerName, $request->getControllerName(), $uri);
        $this->assertEquals($actionName, $request->getActionName(), $uri);
    }

    /**
     * @return array
     */
    public function routeUrlProvider()
    {
        return [
            ['members', [], '/kendoplatform/members'],
            ['profile/friends', ['name' => 'namnv'], '/kendoplatform/namnv/friends'],
            ['user_profile/friends', ['name' => 'namnv'], '/kendoplatform/namnv/friends']
        ];
    }

    /**
     * @dataProvider routeUrlProvider
     *
     * @param string $name
     * @param array  $params
     * @param string $url
     */
    public function testRouteUrl($name, $params, $url)
    {
        $str = \App::routing()->getUrl($name, $params);

        $this->assertEquals($url, $str);
    }
}
