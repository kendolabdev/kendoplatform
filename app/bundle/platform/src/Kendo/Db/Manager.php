<?php

/**
 * @author   Nam Nguyen <namnv@younetco.com>
 * @version  1.0.1
 * @catehory Kendo
 * @package  Kendo
 * @date $date
 */

namespace Kendo\Db;

/**
 * Class Manager
 *
 * @package Kendo\Db
 */
class Manager
{
    /**
     * @var array
     */
    private $config = [];
    /**
     * @var string
     */
    private $tablePrefix = 'kendo_';
    /**
     * @var string
     */
    private $defaultDriverName = 'default';
    /**
     * @var array [AclDriver]
     */
    private $drivers = [];

    /**
     * @var array
     */
    private $tables = [];

    /**
     * @var bool
     */
    private $_installed = false;

    /**
     * private constructor
     *
     * @ignore
     */
    public function __construct()
    {
        if (file_exists($file = KENDO_CONFIG_DIR . '/database.conf.php')) {
            $data = include $file;
            if (!empty($data)) {
                $this->config = $data;
                $this->setPrefix($this->config['prefix']);
                $this->setInstalled(true);
            }
        }
    }

    /**
     * @return boolean
     */
    public function isInstalled()
    {
        return $this->_installed;
    }

    /**
     * @param boolean $installed
     */
    public function setInstalled($installed)
    {
        $this->_installed = $installed;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param array $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @param string $prefix
     *
     * @return void
     */
    public function setPrefix($prefix)
    {
        $this->tablePrefix = $prefix;
    }

    /**
     * @param null $name
     *
     * @return Connection
     */
    public function getMaster($name = null)
    {
        return $this->getDriver($name)->getMaster();
    }

    /**
     * @param null $name
     *
     * @return Driver
     * @throws ConnectionException
     * @throws Exception
     */
    public function getDriver($name = null)
    {
        if (null == $name) {
            $name = $this->getDefaultDriverName();
        }

        if (!isset($this->drivers[ $name ])) {
            $this->drivers[ $name ] = $this->createDriver($name);
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
     * @param string $name
     */
    public function setDefaultDriverName($name)
    {
        $this->defaultDriverName = $name;
    }

    /**
     * @param  string $name
     *
     * @return Driver
     * @throws ConnectionException
     * @throws Exception
     */
    public function createDriver($name)
    {

        if (!isset($this->config[ $name ])) {
            throw new Exception('Db configure is not valid.');
        }

        $config = $this->config[ $name ];
        $driverType = $config['driver'];
        $replicate = $config['replicate'];

        $params = [
            'charset'  => $config['charset'],
            'database' => $config['database'],
            'user'     => $config['user'],
            'password' => $config['password'],
            'master'   => $config['master'],
            'slave'    => isset($config['slave']) ? $config['slave'] : [],
        ];

        switch (strtolower($driverType)) {
            case 'mysqli':
                return new DriverMysqli($replicate, $params);
            default:
                throw new ConnectionException("Db $driverType is not supported");
        }
    }

    /**
     * @param null $name
     *
     * @return Connection
     */
    public function getSlave($name = null)
    {
        return $this->getDriver($name)->getSlave();
    }

    /**
     * Get table prefix
     *
     * @return string
     */
    public function getPrefix()
    {
        return $this->tablePrefix;
    }

    /**
     * @param string $table
     *
     * @return string
     */
    public function getName($table)
    {
        return $this->tablePrefix . $table;
    }

    /**
     * @param $class
     *
     * @return DbTable
     */
    public function getTable($class)
    {

        if (!isset($this->tables[ $class ])) {
            if (!class_exists($class)) {
                throw new \RuntimeException("Could ot load class " . $class);
            }
            $this->tables[ $class ] = new $class();
        }

        return $this->tables[ $class ];
    }
}