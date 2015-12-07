<?php

namespace Kendo\Cache;

/**
 * Class Manager
 *
 * @package Kendo
 */
class Manager
{

    /**
     * @var string
     */
    protected $defaultDriverName = 'default';

    /**
     * @var array|mixed
     */
    protected $configs = [];

    /**
     * @var array
     */
    protected $drivers = [];

    /**
     * @ignore
     */
    public function __construct()
    {
        if (file_exists($file = Kendo_CONFIG_DIR . '/cache.inc.php')) {
            $this->configs = include $file;
        }
    }

    /**
     * @param string $name
     * @param array  $params
     *
     * @return $this
     */
    public function addConfig($name, $params)
    {
        $this->configs[ $name ] = $params;

        return $this;
    }

    /**
     * @param string         $name
     * @param CacheInterface $driver
     *
     * @return $this
     */
    public function setDriver($name, CacheInterface $driver)
    {
        $this->drivers[ $name ] = $driver;

        return $this;
    }

    /**
     * @param string|array $key
     * @param mixed        $data
     * @param null         $minutes
     *
     * @return mixed
     */
    public function set($key, $data, $minutes = null)
    {
        return $this->getDriver()->set($key, $data, $minutes);
    }

    /**
     * @param string $name
     *
     * @return CacheInterface
     */
    public function getDriver($name = null)
    {
        if (null == $name) {
            $name = $this->getDefaultDriverName();
        }

        if (!isset($this->drivers[ $name ])) {
            if (!isset($this->configs[ $name ])) {
                $this->drivers[ $name ] = $this->createDriver('file', []);
            } else {
                $this->drivers[ $name ] = $this->createDriver($this->configs[ $name ]['driver'], $this->configs[ $name ]['params']);
            }
        }

        return $this->drivers[ $name ];
    }

    /**
     * @return string
     */
    public function getDefaultDriverName()
    {
        return $this->defaultDriverName;
    }

    /**
     * @param string $defaultDriverName
     *
     * @return $this
     */
    public function setDefaultDriverName($defaultDriverName)
    {
        $this->defaultDriverName = $defaultDriverName;

        return $this;
    }

    /**
     * @param string $driver
     * @param array  $params
     *
     * @return CacheInterface
     * @throws \InvalidArgumentException
     */
    public function createDriver($driver, $params)
    {

        switch ($driver) {
            case 'file':
            case 'stream':
            case 'filesystem':
                return new CacheFilesystem($params);
            default:
                throw new \InvalidArgumentException(sprintf('Cache storage "%s" does not support'), $driver);
        }
    }

    /**
     * @param string|array  $key
     * @param int           $minutes
     * @param \Closure|null $closure
     *
     * @return mixed
     */
    public function get($key, $minutes = 0, \Closure $closure = null)
    {
        return $this->getDriver()->get($key, $minutes, $closure);
    }

    /**
     * @param string|array $key
     *
     * @return mixed
     */
    public function forget($key)
    {
        return $this->getDriver()->forget($key);
    }

    /**
     * flush all cache
     */
    public function flush()
    {
        $this->getDriver()->flush();
    }
}