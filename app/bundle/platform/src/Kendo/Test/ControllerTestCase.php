<?php
namespace Kendo\Test;

use Kendo\Request\HttpRequest;

/**
 * Class ControllerTestCase
 *
 * @package Kendo\Test
 */
class ControllerTestCase extends TestCase
{
    /**
     * @var \Kendo\Request\HttpRequest
     */
    protected $request;

    /**
     * Protected generate setup.
     */
    protected function setUp()
    {
        parent::setUp();
    }

    protected function reset()
    {
        $this->request = null;
    }

    /**
     * @param string $uri
     * @param string $method
     * @param array  $params
     */
    public function dispatch($uri, $method = 'get', $params = [])
    {
        $this->request = new HttpRequest($uri);
        $this->request->setMethod($method);
        $this->request->setParams($params);
        $this->request->dispatch();

        $this->dump();
    }

    /**
     * @param string $message
     */
    public function assertNoException($message = null)
    {
        $this->assertEmpty($this->request->getException(), $message);
    }

    /**
     * @param string $exceptionClass
     * @param string $message
     */
    public function assertExpectedException($exceptionClass, $message = null)
    {
        $this->assertInstanceOf($exceptionClass, $this->request->getException(), $message);
    }

    /**
     * @param string $controllerName Expected controller name
     * @param string $message        Fail message
     */
    public function assertControllerName($controllerName, $message = null)
    {
        $this->assertEquals($controllerName, $this->request->getControllerName(), $message);
    }

    /**
     * @param string $actionName Expected action name
     * @param string $message    Failure message
     */
    public function assertActionName($actionName, $message = null)
    {
        $this->assertEquals($actionName, $this->request->getActionName(), $message);
    }

    /**
     * @param string $fullControllerName Expected full controller name
     * @param string $message            Failure message
     */
    public function assertFullControllerName($fullControllerName, $message = null)
    {
        $this->assertEquals($fullControllerName, $this->request->getFullControllerName(), $message);
    }

    public function dump()
    {
        $exception = $this->request->getException();
        if ($exception) {
            $message = $exception->getMessage();
            if (!empty($message)) {
                echo sprintf('"%s"', $message);
            } else {
                echo var_export($exception, 1);
            }
        }

        echo $this->request->getFullControllerName(), PHP_EOL;
    }
}