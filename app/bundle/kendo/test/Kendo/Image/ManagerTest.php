<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/10/15
 * Time: 1:47 PM
 */

namespace Kendo\Image;


class ManagerTest extends \PHPUnit_Framework_TestCase
{

    public function testGeneral()
    {
        $manager = new Manager();

        $filename = KENDO_STATIC_DIR . '/nophoto/event_avatar_lg.jpg';

        $image = $manager->load($filename);

        $image->destroy();
    }
}
