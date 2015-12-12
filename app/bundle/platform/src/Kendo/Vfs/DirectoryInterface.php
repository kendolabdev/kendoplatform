<?php
namespace Kendo\Vfs;

/**
 * Interface DirectoryInterface
 *
 * @package Kendo\Vfs
 */
interface DirectoryInterface extends \Iterator, \SeekableIterator
{
    /**
     * DirectoryInterface constructor.
     *
     * @param DriverInterface  $driver
     * @param                  $path
     * @param array|null       $contents
     */
    public function __construct(DriverInterface $driver, $path, array $contents = null);

    /**
     * @return mixed
     */
    public function getDriver();

    /**
     * @return mixed
     */
    public function getPath();

    /**
     * @return mixed
     */
    public function toArray();
}