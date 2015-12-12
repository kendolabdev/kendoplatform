<?php
namespace Kendo\Vfs;

/**
 * Class StandardInfo
 *
 * @package Kendo\Vfs
 */
class StandardInfo implements InfoInterface
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
     * @var array
     */
    protected $info;

    /**
     * StandardInfo constructor.
     *
     * @param DriverInterface  $driver
     * @param                  $path
     * @param array|null       $info
     */
    public function __construct(DriverInterface $driver, $path, array $info = null)
    {
        $this->driver = $driver;
        $this->path = $path;
        $this->info = $info;
        $this->init();
    }

    /**
     * @return array
     */
    public function __sleep()
    {
        return ['_path', '_info'];
    }

    /**
     *
     */
    public function init()
    {

    }

    /**
     * @return DriverInterface
     */
    public function getDriver()
    {
        if (null === $this->driver) {
            throw new InfoException('No adapter registered. This object may have been serialized');
        }

        return $this->driver;
    }

    /**
     * @return array|null
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     *
     */
    public function reload()
    {
        $this->info = $this->getDriver()->stat($this->path);
    }


    // Tree

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->getDriver()->info($this->getDirectoryName());
    }

    /**
     * @return bool|mixed
     */
    public function getChildren()
    {
        if (!$this->isDirectory()) {
            return false;
        }

        return $this->getDriver()->directory($this->path);
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
    public function getBaseName()
    {
        return basename($this->path);
    }

    /**
     * @return string
     */
    public function getDirectoryName()
    {
        return dirname($this->path);
    }

    /**
     * @return mixed
     */
    public function getRealPath()
    {
        // Note: most of the time it will be real already
        return $this->path;
    }

    /**
     * @return mixed
     */
    public function toString()
    {
        return $this->path;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->path;
    }

    /**
     * @return bool
     */
    public function exists()
    {
        return (bool)@$this->info['exists'];
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return @$this->info['type'];
    }

    /**
     * @return bool
     */
    public function isDirectory()
    {
        return (@$this->info['type'] == 'dir');
    }

    /**
     * @return bool
     */
    public function isFile()
    {
        return (@$this->info['type'] == 'file');
    }

    /**
     * @return bool
     */
    public function isLink()
    {
        return (@$this->info['type'] == 'link');
    }


    // Stat

    /**
     * @return mixed
     */
    public function getUid()
    {
        return @$this->info['uid'];
    }

    /**
     * @return mixed
     */
    public function getGid()
    {
        return @$this->info['gid'];
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return @$this->info['size'];
    }

    /**
     * @return mixed
     */
    public function getAtime()
    {
        return @$this->info['atime'];
    }

    /**
     * @return mixed
     */
    public function getMtime()
    {
        return @$this->info['mtime'];
    }

    /**
     * @return mixed
     */
    public function getCtime()
    {
        return @$this->info['ctime'];
    }


    // Perms

    /**
     * @return mixed
     */
    public function getRights()
    {
        return @$this->info['rights'];
    }

    /**
     * @return bool
     */
    public function isExecutable()
    {
        if (!isset($this->info['executable'])) {
            $this->info['executable'] = $this->getDriver()->checkPerms(0x001, $this->getRights(), $this->getUid(), $this->getGid());
        }

        return (bool)$this->info['executable'];
    }

    /**
     * @return bool
     */
    public function isReadable()
    {
        if (!isset($this->info['readable'])) {
            $this->info['readable'] = $this->getDriver()->checkPerms(0x004, $this->getRights(), $this->getUid(), $this->getGid());
        }

        return (bool)$this->info['readable'];
    }

    /**
     * @return bool
     */
    public function isWritable()
    {
        if (!isset($this->info['writable'])) {
            $this->info['writable'] = $this->getDriver()->checkPerms(0x002, $this->getRights(), $this->getUid(), $this->getGid());
        }

        return (bool)$this->info['writable'];
    }

    /**
     * @param string $mode
     *
     * @return mixed
     */
    public function open($mode = 'r')
    {
        return $this->getDriver()->object($this->path, $mode);
    }
}