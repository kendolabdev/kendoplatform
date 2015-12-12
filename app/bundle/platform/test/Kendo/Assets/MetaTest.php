<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/9/15
 * Time: 2:46 PM
 */

namespace Kendo\Assets;


class MetaTest extends \PHPUnit_Framework_TestCase
{
    public function testGeneral()
    {
        $meta = new Meta();

        $this->assertEmpty($meta->get('first'));
        $this->assertNotEmpty($meta->render());
        $this->assertNotEmpty($meta->getVars());

        $vars = ['test1', 'test2'];
        $meta->setVars($vars);
        $this->assertEquals($vars, $meta->getVars());

        $this->assertNotEmpty($meta->render());
    }
}
