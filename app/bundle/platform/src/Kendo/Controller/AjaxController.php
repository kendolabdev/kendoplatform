<?php

namespace Kendo\Controller;

use Kendo\Http\HttpRequest;

/**
 * Class AjaxController
 *
 * @package Kendo\Controller
 */
class AjaxController implements ControllerInterface
{
    /**
     * @var HttpRequest
     */
    protected $request;

    /**
     * @var array
     */
    protected $response = [];

    /**
     * @param HttpRequest $request
     */
    public function __construct(HttpRequest $request)
    {
        $this->request = $request;
        $this->init();
    }

    protected function init()
    {
        header('Content-Type: application/json');
    }

    /**
     * @param string $script
     * @param array  $data
     *
     * @return string
     */
    public function partial($script, $data)
    {
        return app()->viewHelper()->partial($script, $data);
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function execute()
    {
        try {
            $this->request->setDispatched(true);

            $methodName = $this->getMethodName();

            if (!method_exists($this, $methodName)) {
                throw new \InvalidArgumentException("method does not exists");
            }

            $this->{$methodName}();

        } catch (\Exception $e) {
            $this->request->setException($e);
            $this->request->forward('\Platform\Core\Controller\Ajax\ErrorController', 'exception');
        }

        return true;
    }

    /**
     * @return string
     * @throws NotFoundException
     */
    protected function getMethodName()
    {
        $methodName = 'action' . str_replace(' ', '', ucwords(str_replace(['_', '-', '.'], [' ', ' ', ' '], $this->request->getActionName())));

        if (!method_exists($this, $methodName)) {
            $msg = strtr(":controller:::method does not support", [
                ':controller' => $this->request->getControllerName(),
                ':method'     => $methodName,
            ]);
            throw new NotFoundException($msg);
        }

        return $methodName;
    }

    /**
     * @return string
     */
    public function render()
    {
        return json_encode($this->response);
    }
}