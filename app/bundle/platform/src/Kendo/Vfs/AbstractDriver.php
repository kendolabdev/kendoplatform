<?php
namespace Kendo\Vfs;

/**
 * Class AbstractAdapter
 *
 * @package Kendo\Vfs
 */
abstract class AbstractDriver implements DriverInterface
{
    /**
     * @var int
     */
    protected $vfsId = 0;

    /**
     * @var string
     */
    protected $driverType;

    /**
     * @var string
     */
    protected $basePath;

    /**
     * @var
     */
    protected $resource;

    /**
     * @var string
     */
    protected $directorySeparator = '/';

    /**
     * @var int
     */
    protected $umask = 0022;

    /**
     * @var string
     */
    protected $systemType;

    /**
     * @var int
     */
    protected $uid;

    /**
     * @var int
     */
    protected $gid;

    /**
     * AbstractAdapter constructor.
     *
     * @param array|null $driverConfig
     */
    public function __construct($driverConfig = [])
    {
        foreach ($driverConfig as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * @param       $method
     * @param array $arguments
     */
    public function __call($method, array $arguments)
    {
        throw new DriverException(sprintf('Method "%s" not supported in class "%s"', $method, get_class($this)));
    }

    /**
     * @return array
     */
    public function __sleep()
    {
        return ['_path', '_directorySeparator', '_adapterType', '_adapterPrefix', '_umask'];
    }

    /**
     * @return string
     */
    public function getDriverType()
    {
        if (null === $this->driverType) {
            $this->driverType = ltrim(strrchr(get_class($this), '_'), '_');
        }

        return $this->driverType;
    }


    /**
     * @return mixed
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * @return string
     */
    public function getDirectorySeparator()
    {
        return $this->directorySeparator;
    }

    /**
     * @param string $basePath
     *
     * @return DriverInterface
     */
    public function setBasePath($basePath)
    {
        if (empty($basePath)) {
            $basePath = KENDO_PUBLIC_DIR;
        }

        $this->changeDirectory($basePath, false);

        return $this;
    }

    /**
     * @param $umask
     *
     * @return $this
     */
    public function setUmask($umask)
    {
        $this->umask = (int)$umask;

        return $this;
    }

    /**
     * @param null $withPermission
     *
     * @return int
     */
    public function getUmask($withPermission = null)
    {
        if (null === $withPermission) {
            return $this->umask;
        } else {
            return (int)$withPermission & ~$this->umask;
        }
    }

    /**
     * @param string $path
     *
     * @return mixed|string
     */
    public function getPath($path = '')
    {
        if ('' == $path || '.' == $path) {
            return $this->printDirectory();
        }

        $ds = $this->getDirectorySeparator();

        // Check for windows absolute paths
        $drive_letter = null;
        if ($this->getSystemType() == self::SYSTEM_WINDOW && preg_match('~^[a-z][:][/\\\\]~i', $path, $m)) {
            $drive_letter = substr($path, 0, 2);
            $path = $ds . substr($path, 3);
        } // Resolve absolute paths
        else if ($path[0] != '/' && $path[0] != '\\' && $path[0] != '~') {
            $path = $this->printDirectory() . '/' . $path;
        } // Remote home paths
        else if ($path[0] == '~') {
            // @todo just remove for now
            $path = ltrim($path, '~/\\');
        }

        // Replace directory separators and remove double slashes and trailing slashes
        $path = preg_replace('~[/\\\\]+~', $ds, $path);
        $path = rtrim($path, $ds);

        // Remove dotpaths
        $path = str_replace($ds . '.' . $ds, $ds, $path);
        $path = preg_replace('~[/\\\\]\.$~', '', $path);
        do {
            $path = preg_replace('~[/\\\\][^/\\\\]+[/\\\\]\.\.|\.\.[/\\\\][^/\\\\]+[/\\\\]~', '', $path, 1, $count);
        } while ($count > 0);

        // Make sure we aren't left with an empty string or a double dot path
        if ($path == '' || $path == '/..') {
            $path = '/';
        }

        if ($drive_letter) {
            $path = $drive_letter . $path;
        }

        return $path;
    }

    /**
     * @return string
     */
    public function getBasePath()
    {
        if (null == $this->basePath) {
            $this->basePath = KENDO_PUBLIC_DIR;
        }

        return $this->basePath;
    }

    // Factory

    /**
     * @param string $path
     *
     * @return DirectoryInterface
     */
    public function directory($path = '')
    {
        $path = $this->getPath($path);
        $children = $this->listDirectory($path, true);


        foreach ($children as $index => $child) {
            if (is_string($child)) {
                $children[ $index ] = $this->info($child);
            } else if (is_array($child)) {
                $children[ $index ] = new StandardInfo($this, $child['path'], $child);
            } else if (!($child instanceof InfoInterface)) {
                // throw or continue?
                continue;
            }
        }

        return new StandardDirectory($this, $path, $children);
    }

    /**
     * @param string $path
     *
     * @return InfoInterface
     */
    public function info($path = '')
    {
        $path = $this->getPath($path);
        $info = $this->stat($path);

        return new StandardInfo($this, $path, $info);
    }


    /**
     * @param $path
     * @param $pattern
     *
     * @return array
     */
    public function search($path, $pattern)
    {
        $path = $this->getPath($path);
        $matches = [];

        if (!is_string($pattern)) {
            return $matches;
        }

        $directory = $this->directory($path);
        foreach ($directory as $child) {
            if (preg_match($pattern, $child->getPath())) {
                $matches[] = $child->getPath();
            }
            if ($child->isDirectory()) {
                $matches = array_merge($matches, $this->search($child->getPath(), $pattern));
            }
        }

        return $matches;
    }

    /**
     * @param $path
     * @param $fullPath
     *
     * @return array|bool|mixed|string
     */
    public function findJailedPath($path, $fullPath)
    {
        $path = $this->getPath($path);
        $matches = [];

        if (!is_string($fullPath)) {
            return $matches;
        }
        $fullPath = $this->getPath($fullPath);
        $parts = array_filter(explode('/', str_replace('\\', '/', $fullPath)));

        while (count($parts) > 0) {
            $partialPath = $this->getPath(join($this->getDirectorySeparator(), $parts));
            if ($this->exists($partialPath)) {
                return $partialPath;
            }
            array_shift($parts);
        }

        return false;
    }


    // Utility

    /**
     * @param $type
     * @param $mode
     * @param $uid
     * @param $gid
     *
     * @return bool|null
     */
    public function checkPerms($type, $mode, $uid, $gid)
    {
        if ($type !== 1 && $type !== 2 && $type !== 4) {
            return null;
        }

        if (!$mode) {
            return false;
        }

        // Prep
        if (is_int($mode)) {
            $mode = $mode & 0777;
        } else if (preg_match('/([0-1]?)([0-7]{3})/', $mode, $m)) {
            // Octal mode
            list($null, $d, $perms) = $m;
            list($o, $g, $p) = str_split($perms);
            $o = (int)$o;
            $g = (int)$g;
            $p = (int)$p;
        } else if (preg_match('/(d?)([rwx-]{9})/', $mode, $m)) {
            // The human (scoff) readable mode
            list($null, $d, $perms) = $m;
            list($o, $g, $p) = str_split($perms, 3);
            $o = ((strpos($o, 'r') !== false) ? 4 : 0) + ((strpos($o, 'w') !== false) ? 2 : 0) + ((strpos($o, 'x') !== false) ? 1 : 0);
            $g = ((strpos($g, 'r') !== false) ? 4 : 0) + ((strpos($g, 'w') !== false) ? 2 : 0) + ((strpos($g, 'x') !== false) ? 1 : 0);
            $p = ((strpos($p, 'r') !== false) ? 4 : 0) + ((strpos($p, 'w') !== false) ? 2 : 0) + ((strpos($p, 'x') !== false) ? 1 : 0);
        } else {
            // Whoops couldn't find anything
            return false;
        }

        // Calc
        $myUid = $this->getUid();
        $myGid = $this->getGid();

        if (false !== $myUid && $uid === $myUid && ($o & $type)) {
            return true;
        }

        if (false !== $myGid && $gid === $myGid && ($g & $type)) {
            return true;
        }

        if ($p & $type) {
            return true;
        }

        return false;
    }


    // Static utility

    /**
     * @param            $mode
     * @param bool|false $asOct
     *
     * @return int|number|string
     */
    static public function processMode($mode, $asOct = false)
    {
        if (is_string($mode)) {
            // 0777 / 777 mode
            if (preg_match('/^[0-1]?([0-7][0-7][0-7])$/', $mode, $m)) {
                $return = octdec($m[1]);
            } else if (preg_match('/^d?([rwx-]{9})$/', $mode, $m)) {
                $perms = str_replace(['r', 'w', 'x', '-'], ['4', '2', '1', '0'], $m[1]);
                $mode = sprintf('%d%d%d', ($perms[0] + $perms[1] + $perms[2]), ($perms[3] + $perms[4] + $perms[5]), ($perms[6] + $perms[7] + $perms[8]));
                $return = octdec($mode);
            } else {
                throw new DriverException(sprintf('Unable to process mode: %s', $mode));
            }
        } else if (is_integer($mode)) {
            if ($mode >= 0 && $mode <= octdec('777')) {
                $return = $mode;
            } else {
                throw new DriverException(sprintf('Unable to process mode: %s', $mode));
            }
        } else {
            throw new DriverException(sprintf('Unable to process mode: %s', $mode));
        }

        if ($asOct) {
            return sprintf('%o', $return);
        } else {
            return $return;
        }
    }

    /**
     * @param $systype
     *
     * @return string
     */
    static public function processSystemType($systype)
    {
        switch (strtoupper(substr($systype, 0, 3))) {
            case 'LIN':
                return self::SYSTEM_LINUX;
                break;
            case 'UNI':
                return self::SYSTEM_UNIX;
                break;
            case 'WIN':
                return self::SYSTEM_WINDOW;
                break;
            case 'DAR':
                return self::SYSTEM_DARWIN;
                break;
            case 'FRE':
            case 'OPE':
                if (stripos($systype, 'BSD') === false) {
                    throw new DriverException(sprintf('Unknown remote system type: %s', $systype));
                }
                break;
            case 'BSD':
                return self::SYSTEM_BSD;
                break;
            default:
                throw new DriverException(sprintf('Unknown remote system type: %s', $systype));
                break;
        }
    }

    /**
     * @return int
     */
    public function getVfsId()
    {
        return $this->vfsId;
    }

    /**
     * @param int $vfsId
     */
    public function setVfsId($vfsId)
    {
        $this->vfsId = $vfsId;
    }

    /**
     * @return bool
     */
    public function openStack()
    {
        $this->closeStack();

        return stream_wrapper_register('stack', __CLASS__);
    }

    /**
     *
     */
    public function closeStack()
    {
        $existed = in_array('stack', stream_get_wrappers());
        if ($existed) {
            stream_wrapper_unregister('stack');
        }
    }
}