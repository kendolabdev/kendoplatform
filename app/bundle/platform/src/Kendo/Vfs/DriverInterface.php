<?php
namespace Kendo\Vfs;
/**
 * Interface AdapterInterface
 *
 * @package Kendo\Vfs
 */
interface DriverInterface
{
    /**
     * @var string
     */
    const SYSTEM_LINUX = 'linux';
    /**
     * @var string
     */
    const SYSTEM_UNIX = 'unix';
    /**
     * @var string
     */
    const SYSTEM_WINDOW = 'windows';
    /**
     * @var string
     */
    const SYSTEM_DARWIN = 'darwin';
    /**
     * @var string
     */
    const SYSTEM_BSD = 'bsd';

    /**
     * AdapterInterface constructor.
     *
     * @param array|null $driverConfig
     */
    public function __construct($driverConfig = []);

    /**
     * @return mixed
     */
    public function getDriverType();

    /**
     * @return mixed
     */
    public function getResource();

    /**
     * @return mixed
     */
    public function getDirectorySeparator();

    /**
     * @param null $withPermission
     *
     * @return mixed
     */
    public function getUmask($withPermission = null);

    /**
     * @param $path
     *
     * @return bool
     */
    public function exists($path);

    /**
     * @param $path
     *
     * @return bool
     */
    public function isDirectory($path);

    /**
     * @param $path
     *
     * @return bool
     */
    public function isFile($path);

    /**
     * @param string $path
     *
     * @return string
     */
    public function getPath($path = '');

    /**
     * @return string
     */
    public function getSystemType();

    /**
     * @param $path
     *
     * @return mixed
     */
    public function stat($path);

    /**
     * @param string $path
     *
     * @return DirectoryInterface
     */
    public function directory($path = '');

    /**
     * @param string $path
     *
     * @return InfoInterface
     */
    public function info($path = '');

    /**
     * @param string $path
     * @param string $mode
     *
     * @return ObjectInterface
     */
    public function object($path, $mode = 'r');

    /**
     * @param $sourcePath
     * @param $destPath
     *
     * @return bool
     */
    public function copy($sourcePath, $destPath);

    /**
     * @param $local
     * @param $path
     *
     * @return mixed
     */
    public function get($local, $path);

    /**
     * @param $path
     *
     * @return mixed
     */
    public function getContents($path);

    /**
     * @param            $path
     * @param            $mode
     * @param bool|false $recursive
     *
     * @return bool
     */
    public function mode($path, $mode, $recursive = false);

    /**
     * @param $oldPath
     * @param $newPath
     *
     * @return bool
     */
    public function move($oldPath, $newPath);

    /**
     * @param string $path
     * @param string $local
     * @param int    $permission
     *
     * @return bool
     */
    public function put($path, $local, $permission = 0666);

    /**
     * @param $path
     * @param $data
     *
     * @return bool
     */
    public function putContents($path, $data);

    /**
     * @param $path
     *
     * @return bool
     */
    public function unlink($path);

    /**
     * @param $directory
     *
     * @return bool
     */
    public function changeDirectory($directory);

    /**
     * @param            $directory
     * @param bool|false $details
     *
     * @return mixed
     */
    public function listDirectory($directory, $details = false);

    /**
     * @param string     $directory
     * @param bool|false $recursive
     * @param int        $permission
     *
     * @return bool
     */
    public function makeDirectory($directory, $recursive = false, $permission = 0755);

    /**
     * @return mixed
     */
    public function printDirectory();

    /**
     * @param            $directory
     * @param bool|false $recursive
     *
     * @return bool
     */
    public function removeDirectory($directory, $recursive = false);

    /**
     * @return mixed
     */
    public function getUid();

    /**
     * @return mixed
     */
    public function getGid();
}