<?php
namespace Kendo\Vfs;

/**
 * Class AbstractObject
 *
 * @package Kendo\Vfs
 */
abstract class AbstractObject implements ObjectInterface
{
    /**
     * @var DriverInterface
     */
    protected $driver;

    /**
     * @var
     */
    protected $path;

    /**
     * @var string
     */
    protected $mode;

    /**
     * @var
     */
    protected $resource;

    /**
     * AbstractObject constructor.
     *
     * @param DriverInterface  $driver
     * @param                  $path
     * @param string           $mode
     */
    public function __construct(DriverInterface $driver, $path, $mode = 'r')
    {
        $this->driver = $driver;
        $this->path = $driver->getPath($path);
        $this->mode = $mode;
        $this->open($mode);
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @return mixed
     */
    public function getResource()
    {
        if (!$this->resource) {
            throw new ObjectException('No resource');
        }

        return $this->resource;
    }

    /**
     * @return mixed
     */
    public function getFileInfo()
    {
        return $this->driver->info($this->path);
    }
}