<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/10/15
 * Time: 9:49 AM
 */

namespace Kendo\Request;

/**
 * Class HttpResultTest
 *
 * @package Kendo\Request
 */
class HttpResultTest extends \PHPUnit_Framework_TestCase
{

    public function testGeneral()
    {
        $httpResult  = new HttpResult();

        $this->assertEmpty($httpResult->getData());

        $httpResult->setData('example');

        $this->assertEquals('example', $httpResult->getData());

        $httpResult->reset();

        $this->assertEmpty($httpResult->getData());
    }
}
