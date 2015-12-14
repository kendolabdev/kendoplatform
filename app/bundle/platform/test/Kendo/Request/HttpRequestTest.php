<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/10/15
 * Time: 9:53 AM
 */

namespace Kendo\Request;

class HttpRequestTest extends \PHPUnit_Framework_TestCase
{

    public function testGeneral()
    {
        $httpRequest = new HttpRequest('http://tuoitre.com.vn/conduongcuqua?q=example_query&page=2&t[]=4');

        $this->assertEquals(['example_query'], $httpRequest->get('q'));
        $this->assertEquals('example_query', $httpRequest->getParam('q'));
        $this->assertEquals('example_query', $httpRequest->getString('q'));

        $defaultValue = 'testvalue';

        $this->assertEmpty($httpRequest->getGET());
        $this->assertEmpty($httpRequest->getPOST());
        $this->assertNotEmpty($httpRequest->getQuery());
        $this->assertEmpty($httpRequest->getPOST());

        $this->assertEquals('2', $httpRequest->getParam('page'));
        $this->assertEquals(2, $httpRequest->getInt('page'));

        $this->assertEquals(['4'], $httpRequest->getArray('t'));
        $this->assertEmpty([], $httpRequest->getArray('no_array'));
        $this->assertEquals([1], $httpRequest->getArray('no_array', [1]));

        $this->assertEquals($defaultValue, $httpRequest->getParam('no_query', $defaultValue));
        $this->assertEquals($defaultValue, $httpRequest->getString('no_query', $defaultValue));
        $this->assertEquals($defaultValue, $httpRequest->getParam('no_query', $defaultValue));

        $this->assertTrue($httpRequest->isGet());
        $httpRequest->getResponse();

        $this->assertFalse($httpRequest->isPut());
        $this->assertFalse($httpRequest->isPost());
        $this->assertFalse($httpRequest->isPost());
        $this->assertFalse($httpRequest->isAjax());
        $this->assertFalse($httpRequest->isDelete());
        $this->assertFalse($httpRequest->isOptions());
        $this->assertEmpty($httpRequest->getFragment());

        $httpRequest->setMethod('post');
        $this->assertTrue($httpRequest->isPost());

        $exception = new \RuntimeException('issue');

        $httpRequest->setException($exception);

        $this->assertEquals($exception, $httpRequest->getException());


        $httpRequest->example_params = 12;

        $this->assertEquals($httpRequest->example_params, 12);

        $httpRequest->setPath('/');

        $this->assertEquals($httpRequest->getPath(), '/');

        $httpRequest->setDispatched(false);

        $this->assertFalse($httpRequest->isDispatched());

        $httpRequest->setControllerName('\Platform\Core\Controller\HomeController');
        $httpRequest->setActionName('index');

        $this->assertEquals($httpRequest->getControllerName(), '\Platform\Core\Controller\HomeController');
        $this->assertEquals($httpRequest->getActionName(), 'index');

        $httpRequest->dispatch();

        $httpRequest->setParams(['more' => '2']);
        $this->assertNotEmpty($httpRequest->getParams());

        $this->assertEquals('2', $httpRequest->getParam('more'));

        $httpRequest->getFullControllerName();
    }

    /**
     * @return array
     */
    public function requestPathProvider()
    {
        return [
            ['/'],
            ['members'],
            ['blogs'],
        ];
    }

    /**
     * @dataProvider requestPathProvider
     *
     * @param $path
     */
    public function testRequestPath($path)
    {
        $httpRequest = new HttpRequest($path);

        $httpRequest->dispatch();
    }
}
