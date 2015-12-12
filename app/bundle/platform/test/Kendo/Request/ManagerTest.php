<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/10/15
 * Time: 10:59 AM
 */

namespace Kendo\Request;


class ManagerTest extends \PHPUnit_Framework_TestCase
{


    public function testGeneral()
    {
        $manager = new Manager();

        $this->assertInstanceOf('\Kendo\Request\RequestInterface', $manager->getInitiator());
        $this->assertInstanceOf('\Kendo\Request\Browser', $manager->getBrowser());
        $this->assertFalse($manager->isMobile());
        $this->assertFalse($manager->isTablet());
        $manager->getRouteName();

        $manager->getRouteParams();
        $manager->setRouteParams(['a' => 1]);

        $httpRequest = new HttpRequest('/');

        $manager->setInitiator($httpRequest);
        $this->assertNotEmpty($manager->getRouting());
        $this->assertEquals($httpRequest, $manager->getInitiator());
    }
}
