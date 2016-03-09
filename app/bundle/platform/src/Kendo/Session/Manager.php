<?php
namespace Kendo\Session;
use Kendo\Kernel\KernelService;


/**
 * Class Manager
 * @method open($path, $id)
 * @method close()
 * @method destroy($id)
 * @method read($id)
 * @method write($id, $data)
 * @method gc($lifetime)
 *
 *
 * @package Kendo\Session
 */
class Manager extends KernelService
{

    /**
     * @var \SessionHandlerInterface
     */
    private $saveHandler;

    /**
     */
    public function __construct()
    {
        $saveHandlerClassName = app()->registryService()->get('SessionHandler', '\Platform\Core\Session\FileSaveHandler');

        if (!class_exists($saveHandlerClassName)) {
            throw new \InvalidArgumentException('Unexpected session save handler');
        }

        $saveHandler = new $saveHandlerClassName;

        if (!$saveHandler instanceof \SessionHandlerInterface) {
            throw new \InvalidArgumentException('Session Handler must instance of \SessionSaveHandlerInterface');
        }


        session_set_save_handler(
            [$saveHandler, 'open'],
            [$saveHandler, 'close'],
            [$saveHandler, 'read'],
            [$saveHandler, 'write'],
            [$saveHandler, 'destroy'],
            [$saveHandler, 'gc']);

        $this->saveHandler = $saveHandler;

        if (!headers_sent()) {
            if (!session_start()) {
                throw new \InvalidArgumentException('Could not start session.');
            }
        }

    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->saveHandler, $name], $arguments);
    }
}
