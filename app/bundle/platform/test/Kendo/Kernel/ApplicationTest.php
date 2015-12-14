<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/14/15
 * Time: 12:09 AM
 */

namespace Kendo\Kernel;


class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    public function testGeneral()
    {
        $users = \App::userService();

        $this->assertNotNull($users);

        \App::requester();
    }
}
