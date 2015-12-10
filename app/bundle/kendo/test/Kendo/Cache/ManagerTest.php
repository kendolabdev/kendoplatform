<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/9/15
 * Time: 3:18 PM
 */

namespace Kendo\Cache;


class ManagerTest extends \PHPUnit_Framework_TestCase
{

    public function testGeneral()
    {
        $manager = new Manager();

        $this->assertEquals('default', $manager->getDefaultDriverName());

        $manager->setDefaultDriverName('system');

        $this->assertEquals('system', $manager->getDefaultDriverName());

        $manager->setDefaultDriverName('default');

        $driver = $manager->getDriver();

        $this->assertNotEmpty($driver);

        $manager->createDriver('file', []);

        $driver = $manager->getDriver();

        $driver->flush();

        $driver->get(['test', 'abc'], 0, function () {
            return ['key' => 'val'];
        });

        $driver->set(['test', 'abc'], ['key' => 'val'], 0);

        $this->assertEquals($driver->get(['test', 'abc']), ['key' => 'val']);

        $driver->forget(['test', 'abc']);

        $this->assertTrue($driver->get(['test', 'abc']) == false);
    }
}
