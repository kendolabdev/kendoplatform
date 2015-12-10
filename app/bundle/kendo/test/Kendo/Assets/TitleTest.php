<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/9/15
 * Time: 2:43 PM
 */

namespace Kendo\Assets;


class TitleTest extends \PHPUnit_Framework_TestCase
{

    public function testGeneral()
    {
        $title = new Title();

        $this->assertEmpty($title->getVars());

        $this->assertNotEmpty($title->render());

        $this->assertNotEmpty($title->getGlue());

        $this->assertEmpty($title->toText());

        $vars = ['test1', 'test2'];

        $title->setVars($vars);

        $this->assertEquals($vars, $title->getVars());

        $this->assertNotEmpty($title->render());

        $this->assertNotEmpty($title->toText());
    }
}
