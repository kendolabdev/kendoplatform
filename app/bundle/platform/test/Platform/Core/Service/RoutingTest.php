<?php
namespace Platform\Core\Service;

use Kendo\Request\HttpRequest;
use Kendo\TestCase;

class RoutingTest extends TestCase
{

    /**
     * @return array
     */
    public function provideRoutingResult()
    {


        $result[] = ['/', '\Platform\Core\Controller\HomeController', 'index'];


        $user = \App::table('platform_user')
            ->select()
            ->one();

        $result[] = [$user->toHref(), '\Platform\User\Controller\ProfileController', 'index'];
        $result[] = ['/admin', '\Platform\Core\Controller\Admin\DashboardController', 'index'];

        return $result;
    }

    /**
     * @dataProvider provideRoutingResult
     *
     * @param $url
     * @param $controllerName
     * @param $actionName
     */
    public function testRoutingResult($url, $controllerName, $actionName)
    {
        $routingService = \App::routingService();

        $request = new HttpRequest($url);

        $result = $routingService->match($request);

        $this->assertTrue($result);
        $this->assertEquals($request->getControllerName(), $controllerName);
        $this->assertEquals($request->getActionName(), $actionName);
    }
}