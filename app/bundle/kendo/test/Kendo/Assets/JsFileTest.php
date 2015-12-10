<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/9/15
 * Time: 2:31 PM
 */

namespace Kendo\Assets;


class JsFileTest extends \PHPUnit_Framework_TestCase
{

    public function testGeneral()
    {
        $js = new JsFile();

        $js->clear();

        $this->assertEmpty($js->getVars());

        $js->add('jquery', 'src/jquery.js');

        $js->add('jquery2', ['src' => 'src/jquery2.js']);

        $this->assertNotEmpty($js->getVars());

        $this->assertNotEmpty($js->get('jquery'));

        $js->add('jquery', 'src/jquery2.js');

        $this->assertTrue(count($js->get('jquery')) == 1);

        $this->assertNotEmpty($js->render());

        $js->addAll([
            'underscore'  => 'src/underscore.js',
            'underscore2' => 'src/underscore2.js',
        ]);

        $this->assertNotEmpty($js->render());

        $js->prependAll([
            'slider1' => 'src/slider1.js',
            'slider2' => 'src/slider2.js',
        ]);

        $js->prepend('slider0', 'src/slider0.js');
    }
}
