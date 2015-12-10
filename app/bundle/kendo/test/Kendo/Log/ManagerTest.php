<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/10/15
 * Time: 2:46 PM
 */

namespace Kendo\Log;


use Kendo\TestCase;

/**
 * Class ManagerTest
 *
 * @package Kendo\Log
 */
class ManagerTest extends TestCase
{

    public function testGeneral()
    {
        $manager = new Manager();

        $manager->setDefaultDriverName('default');

        $this->assertEquals($manager->getDefaultDriverName(), 'default');

        $this->assertEquals($manager->getDriver('default'), $manager->getDriver());

        $manager->createDriver('file', []);
        $driver = $manager->createDriver('db', []);

        $manager->setDriver('default', $driver);

        $this->assertEquals($manager->getDriver(), $driver);

        $manager->addConfig('test2', ['driver' => 'file', 'params' => []]);

        $manager->getDriver('test2');


        $faker = $this->getFaker();

        foreach (['log', 'warn', 'crit', 'notice', 'info', 'debug'] as $methodName) {
            $manager->{$methodName}($faker->sentence);
            $manager->{$methodName}($faker->paragraph, ['a' => $faker->paragraph]);
            $manager->{$methodName}($faker->sentence, $faker->paragraph);
            $manager->{$methodName}($faker->paragraph, 2);
            $manager->{$methodName}($faker->paragraph, [1, 2, 3]);
        }

    }


    /**
     * @return array
     */
    public function logProvider()
    {
        return [
            ['\Kendo\Log\FileWriter', []],
            ['\Kendo\Log\FileWriter', ['path' => KENDO_TEMP_DIR . '/log/main.log']],
            ['\Kendo\Log\DbWriter', []],
        ];
    }

    /**
     * @dataProvider logProvider
     *
     * @param $driver
     * @param $driverParams
     */
    public function testDriver($driver, $driverParams)
    {

        $driver = new $driver($driverParams);

        $faker = $this->getFaker();

        foreach (['log', 'warn', 'crit', 'notice', 'info', 'debug'] as $methodName) {
            $driver->{$methodName}($faker->sentence);
            $driver->{$methodName}($faker->paragraph, ['a' => $faker->paragraph]);
            $driver->{$methodName}($faker->sentence, $faker->paragraph);
            $driver->{$methodName}($faker->paragraph, 2);
            $driver->{$methodName}($faker->paragraph, [1, 2, 3]);
        }

    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidDriver()
    {

        $manager = new Manager();
        $manager->createDriver('nosupported');
    }
}
