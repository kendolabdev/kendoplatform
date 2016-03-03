<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/9/15
 * Time: 4:26 PM
 */

namespace Kendo\Sass;


class ManagerTest extends \PHPUnit_Framework_TestCase
{

    public function testGeneral()
    {
        $sass =  new Manager();

        $sass->compile('body{background-color: $red}', ['red'=>'#ff0000'],[],[]);

        $tempFile = KENDO_TEMP_DIR .'/test/unitest.css';

        $sass->compileToFile($tempFile,'default','default',['red'=>'#ff0000'], 'body{background: $red;}');

        $this->assertNotEmpty(file_get_contents($tempFile));
    }
}