<?php
namespace Kendo\Vfs;
/**
 * Class StandardDirectory
 *
 * @package Kendo\Vfs
 */
class StandardDirectory implements DirectoryInterface
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
    protected $contents;

    /**
     * @var int
     */
    protected $position;

    /**
     * StandardDirectory constructor.
     *
     * @param DriverInterface  $driver
     * @param                  $path
     * @param array|null       $contents
     */
    public function __construct(DriverInterface $driver, $path, array $contents = null)
    {
        $this->driver = $driver;
        $this->path = $path;
        $this->position = 0;
        $this->contents = [];

        // Check contents
        foreach ((array)$contents as $content) {
            $adapterClass = get_class($this->driver);
            if (is_string($content)) {
                $content = $this->driver->info($content);
            }
            if (!($content instanceof InfoInterface)) {
                // Throw or ignore?
                continue;
            }
            // Wrong adapter
            if (get_class($content->getDriver()) != $adapterClass) {
                // Throw or ignore?
                continue;
            }
            $this->contents[] = $content;
        }
    }

    /**
     * @return DriverInterface
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->contents;
    }


    // Iterator

    /**
     * @return mixed
     */
    public function current()
    {
        return $this->contents[ $this->position ];
    }

    /**
     * @return int
     */
    public function key()
    {
        return $this->position;
    }

    /**
     *
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     *
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return isset($this->contents[ $this->position ]);
    }

    /**
     * @param int $position
     *
     */
    public function seek($position)
    {
        if (!is_int($position) || !isset($this->contents[ $position ])) {
            throw new \RuntimeException('Seeking out of bounds in Engine_Vfs_Directory_System');
        }
        $this->position = $position;
    }
}