<?php
namespace Kendo\Vfs;

/**
 * Interface InfoInterface
 *
 * @package Kendo\Vfs
 */
interface InfoInterface
{
    /**
     * InfoInterface constructor.
     *
     * @param DriverInterface  $driver
     * @param                  $path
     * @param array|null       $info
     */
    public function __construct(DriverInterface $driver, $path, array $info = null);

    /**
     * @return mixed
     */
    public function getDriver();

    /**
     * @return mixed
     */
    public function reload();

    /**
     * @return mixed
     */
    public function getParent();

    /**
     * @return mixed
     */
    public function getChildren();

    /**
     * @return mixed
     */
    public function getPath();

    /**
     * @return mixed
     */
    public function getBaseName();

    /**
     * @return mixed
     */
    public function getDirectoryName();

    /**
     * @return mixed
     */
    public function getRealPath();

    /**
     * @return mixed
     */
    public function toString();

    /**
     * @return mixed
     */
    public function __toString();

    /**
     * @return mixed
     */
    public function exists();

    /**
     * @return mixed
     */
    public function getType();

    /**
     * @return mixed
     */
    public function isDirectory();

    /**
     * @return mixed
     */
    public function isFile();

    /**
     * @return mixed
     */
    public function isLink();

    /**
     * @return mixed
     */
    public function getUid();

    /**
     * @return mixed
     */
    public function getGid();

    /**
     * @return mixed
     */
    public function getSize();

    /**
     * @return mixed
     */
    public function getAtime();

    /**
     * @return mixed
     */
    public function getMtime();

    /**
     * @return mixed
     */
    public function getCtime();

    /**
     * @return mixed
     */
    public function getRights();

    /**
     * @return mixed
     */
    public function isExecutable();

    /**
     * @return mixed
     */
    public function isReadable();

    /**
     * @return mixed
     */
    public function isWritable();

    /**
     * @param string $mode
     *
     * @return mixed
     */
    public function open($mode = 'r');
}