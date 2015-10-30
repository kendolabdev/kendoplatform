<?php
namespace Picaso\Session;


/**
 * Class Manager
 *
 * @package Picaso\Session
 */
class Manager
{

    /**
     * @var \SessionHandlerInterface
     */
    private $driver;

    /**
     */
    public function __construct()
    {
        $class = \App::registry()->get('SessionHandler', '\Core\Session\FileSaveHandler');

        $handler = new $class;

        if (!$handler instanceof \SessionHandlerInterface) {
            throw new \InvalidArgumentException('Session Handler must instance of \SessionSaveHandlerInterface');
        }


        session_set_save_handler(
            [$handler, 'open'],
            [$handler, 'close'],
            [$handler, 'read'],
            [$handler, 'write'],
            [$handler, 'destroy'],
            [$handler, 'gc']);

        $this->driver = $handler;

        if (!session_start()) {
            throw new \InvalidArgumentException('Could not start session.');
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
        return call_user_func_array([$this->driver, $name], $arguments);
    }
}
