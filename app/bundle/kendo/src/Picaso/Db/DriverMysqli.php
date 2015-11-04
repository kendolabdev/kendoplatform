<?php

namespace Picaso\Db;

/**
 * Class DriverMysqli
 *
 * @package Picaso\Db
 */
class DriverMysqli implements Driver
{

    /**
     * @var Connection
     */
    protected $master;

    /**
     * @var Connection
     */
    protected $slave;

    /**
     * @var bool
     */
    protected $replicate = false;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @param bool  $replicate
     * @param array $params
     */
    public function __construct($replicate, $params)
    {
        $this->replicate = $replicate && count($params['slave']) > 0;
        $this->params = (array)$params;
    }


    /**
     * @param bool $master
     *
     * @return ConnectionMysqli
     */
    public function getConnection($master = true)
    {
        if ($master) {
            return $this->getMaster();
        } else {
            return $this->getSlave();
        }
    }

    /**
     * @return ConnectionMysqli
     */
    public function getMaster()
    {

        if (!$this->master) {
            $this->master = new ConnectionMysqli($this->getRandomizeConnectionParams(true));
        }

        return $this->master;
    }

    /**
     * @param bool $isMaster
     *
     * @return array
     */
    protected function getRandomizeConnectionParams($isMaster = false)
    {

        $array = null;
        $params = null;

        if (false == $this->replicate || $isMaster) {
            $array = $this->params['master'];
        } else {
            $array = $this->params['slave'];
        }

        $length = count($array);

        if ($length == 1) {
            $params = array_shift($array);
        } else {
            $params = $array[ mt_rand(0, $length - 1) ];
        }

        if (isset($this->params['user']) && !isset($params['user'])) {
            $params['user'] = $this->params['user'];
        }

        if (isset($this->params['password']) && !isset($params['password'])) {
            $params['password'] = $this->params['password'];
        }

        if (isset($this->params['database']) && !isset($params['database'])) {
            $params['database'] = $this->params['database'];
        }

        if (isset($this->params['port']) && !isset($params['port'])) {
            $params['port'] = $this->params['port'];
        }

        if (isset($this->params['host']) && !isset($params['port'])) {
            $params['host'] = $this->params['host'];
        }

        if (isset($this->params['socket']) && !isset($params['socket'])) {
            $params['socket'] = $this->params['socket'];
        }

        if (isset($this->params['charset']) && !isset($params['charset'])) {
            $params['charset'] = $this->params['charset'];
        }

        if (isset($this->params['persistent']) && !isset($params['persistent'])) {
            $params['persistent'] = $this->params['persistent'];
        }

        return $params;
    }

    /**
     * @return ConnectionMysqli
     */
    public function getSlave()
    {

        if (false == $this->replicate) {
            return $this->getMaster();
        }

        if (!$this->slave) {
            $this->slave = new ConnectionMysqli($this->getRandomizeConnectionParams(false));
        }

        return $this->slave;
    }
}