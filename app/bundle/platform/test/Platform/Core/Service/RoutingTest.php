<?php
namespace Platform\Core\Service;

use Kendo\Http\HttpRequest;
use Kendo\Test\TestCase;

/**
 * Class RoutingTest
 *
 * @package Platform\Core\Service
 */
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

        $result[] = [$user->toHref(), '\Platform\Feed\Controller\ProfileController', 'timeline'];
        $result[] = ['/admin', '\Platform\Core\Controller\Admin\DashboardController', 'index'];

        return $result;
    }

    /**
     *
     * @dataProvider provideRoutingResult
     *
     * @param $url
     * @param $expectedControllerName
     * @param $expectedActionName
     */
    public function testRoutingResult($url, $expectedControllerName, $expectedActionName)
    {
        $routingService = \App::routing();

        $request = new HttpRequest($url);

        $routingService->resolve($request);

        $this->assertEquals($expectedControllerName, $request->getControllerName(), $url);
        $this->assertEquals($expectedActionName, $request->getActionName(), $url);
    }
}