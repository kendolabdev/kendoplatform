<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/9/15
 * Time: 2:28 PM
 */

namespace Kendo\Assets;


class DescriptionTest extends \PHPUnit_Framework_TestCase
{

    public function testGeneral()
    {
        $description = new Description();

        $this->assertNotEmpty($description->getGlue());

        $description->clear();

        $this->assertEmpty($description->getVars());

        $description->add('test');

        $this->assertNotEmpty($description->getVars());

        $description->render();

        $description->setVars(['abc', 'zyz']);

        $this->assertNotEmpty($description->getVars());

        $this->assertNotEmpty($description->render());

    }
}
