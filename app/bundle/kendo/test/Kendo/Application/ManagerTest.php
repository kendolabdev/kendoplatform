<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/9/15
 * Time: 2:17 PM
 */

namespace Kendo\Application;


class ManagerTest extends \PHPUnit_Framework_TestCase
{


    public function testGeneral()
    {
        $manager = new Manager();

        /**
         * hook bootstrap
         */
        $manager->bootstrap();

        $manager->loadEnableBundles();

        $manager->loadEnableModules();

        $manager->getActiveModuleNames();

        $manager->loadEnableModuleFromRepository();

        $manager->getModuleOptions();

        $manager->getModule('platform_core');
    }
}
