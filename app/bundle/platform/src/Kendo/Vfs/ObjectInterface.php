<?php
namespace Kendo\Vfs;

/**
 * Interface ObjectInterface
 *
 * @package Kendo\Vfs
 */
interface ObjectInterface
{
    /**
     * ObjectInterface constructor.
     *
     * @param DriverInterface  $driver
     * @param                  $path
     * @param string           $mode
     */
    public function __construct(DriverInterface $driver, $path, $mode = 'r');

    /**
     * @return mixed
     */
    public function getPath();

    /**
     * @return mixed
     */
    public function getMode();

    /**
     * @return mixed
     */
    public function getResource();

    /**
     * @return mixed
     */
    public function getFileInfo();

    /**
     * @param string $mode
     *
     * @return mixed
     */
    public function open($mode = 'r');

    /**
     * @return mixed
     */
    public function end();

    /**
     * @return mixed
     */
    public function flush();

    /**
     * @param $length
     *
     * @return mixed
     */
    public function read($length);

    /**
     * @return mixed
     */
    public function rewind();

    /**
     * @param     $offset
     * @param int $whence
     *
     * @return mixed
     */
    public function seek($offset, $whence = SEEK_SET);

    /**
     * @return mixed
     */
    public function stat();

    /**
     * @return mixed
     */
    public function tell();

    /**
     * @param $size
     *
     * @return mixed
     */
    public function truncate($size);

    /**
     * @param      $str
     * @param null $length
     *
     * @return mixed
     */
    public function write($str, $length = null);
}