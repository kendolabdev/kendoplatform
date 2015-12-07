<?php

namespace Kendo\Log;

/**
 * Class Manager
 *
 * @package Kendo\Log
 */
class Manager
{

    const LOG = 'LOG';

    const DEBUG = 'DEBUG';

    const INFO = 'INFO';

    const WARN = 'WARNING';

    const CRIT = 'CRITICAL';

    const NOTICE = 'NOTICE';

    /**
     * @var array(Writer)
     */
    protected $writers = [];

    /**
     * @var string
     */
    protected $defaultDriverName = 'default';

    /**
     * @var array
     */
    protected $configs = [];

    /**
     * @ignore
     */
    public function __construct()
    {
        $this->configs = include Kendo_CONFIG_DIR . '/log.inc.php';
    }

    /**
     * @param string $name
     * @param array  $params
     *
     * @return Manager
     */
    public function addConfig($name, $params)
    {
        $this->configs[ $name ] = $params;

        return $this;
    }

    /**
     * @param string $name
     * @param Driver $writer
     *
     * @return Manager
     */
    public function setDriver($name, Driver $writer)
    {
        $this->writers[ $name ] = $writer;

        return $this;
    }

    /**
     * @param      $msg
     * @param null $data
     *
     * @return Manager
     */
    public function log($msg, $data = null)
    {
        $this->getDriver()->log($msg, $data);

        return $this;
    }

    /**
     * @param null $name
     *
     * @return Driver
     */
    public function getDriver($name = null)
    {

        if (null == $name) {
            $name = $this->getDefaultDriverName();
        }

        if (!isset($this->writers[ $name ])) {
            if (!isset($this->configs[ $name ])) {
                $this->writers[ $name ] = $this->createDriver('stream', []);
            } else {
                $this->writers[ $name ] = $this->createDriver($this->configs[ $name ]['driver'], $this->configs[ $name ]['params']);
            }
        }

        return $this->writers[ $name ];
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
     */
    public function setDefaultDriverName($defaultDriverName)
    {
        $this->defaultDriverName = $defaultDriverName;
    }

    /**
     * @param string $driver
     * @param array  $params
     *
     * @return Driver
     */
    public function createDriver($driver, $params)
    {
        switch ($driver) {
            case 'stream':
            case 'file':
                return new FileDriver($params);
            case 'database':
            case 'db':
            case 'mysqli':
                return new DbDriver($params);
            default:
                throw new \InvalidArgumentException(sprintf('driver "%s" does not supported', $driver));
        }
    }

    /**
     * @param      $msg
     * @param null $data
     *
     * @return $this
     */
    public function info($msg, $data = null)
    {
        $this->getDriver()->info($msg, $data);

        return $this;
    }

    /**
     * @param      $msg
     * @param null $data
     *
     * @return $this
     */
    public function notice($msg, $data = null)
    {
        $this->getDriver()->notice($msg, $data);

        return $this;
    }

    /**
     * @param      $msg
     * @param null $data
     *
     * @return Manager
     */
    public function debug($msg, $data = null)
    {
        $this->getDriver()->debug($msg, $data);

        return $this;
    }

    /**
     * @param      $msg
     * @param null $data
     *
     * @return Manager
     */
    public function crit($msg, $data = null)
    {
        $this->getDriver()->crit($msg, $data);

        return $this;
    }

    /**
     * @param      $msg
     * @param null $data
     *
     * @return Manager
     */
    public function warn($msg, $data = null)
    {
        $this->getDriver()->warn($msg, $data);

        return $this;
    }
}