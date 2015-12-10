<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/10/15
 * Time: 11:15 AM
 */

namespace Kendo\Routing;


use Kendo\Request\HttpRequest;

class ManagerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return array
     */
    public function routingMatchProvider()
    {
        return [
            ['/', [], '\Platform\Core\Controller\HomeController', 'index'],
            ['/members', [], '\Platform\Core\Controller\HomeController', 'index'],
            ['/add-blogs', [], '\Platform\Core\Controller\HomeController', 'index']

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
        $manager = new Manager();

        $manager->addRoute('home', [
            'uri'      => $uri,
            'defaults' => [
                'controller' => $controllerName,
                'action'     => $actionName,
            ]
        ]);

        $request = new HttpRequest($uri);

        $manager->match($request);


    }
}
