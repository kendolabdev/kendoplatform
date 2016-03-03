<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/10/15
 * Time: 11:00 PM
 */

namespace Kendo\Db;


class ManagerTest extends \PHPUnit_Framework_TestCase
{

    public function testGeneral()
    {
        $manager = new DbManager();

        $manager->getConfig();

        $origin = $manager->getDefaultDriverName();

        $manager->setDefaultDriverName('another_driver');

        $this->assertEquals($manager->getDefaultDriverName(), 'another_driver');

        $manager->setDefaultDriverName($origin);

        $this->assertNotEmpty($manager->getConfig());

        $manager->getMaster();
        $manager->getSlave();

        $origin = $manager->getPrefix();

        $manager->setPrefix('another_prefix');
        $this->assertEquals($manager->getPrefix(), 'another_prefix');
        $manager->setPrefix($origin);

    }
}
