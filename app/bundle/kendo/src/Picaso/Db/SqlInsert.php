<?php

/**
 * @author  Nam Nguyen <namnv@younetco.com>
 * @version 1.0.1
 * @package Picaso
 */
namespace Picaso\Db;

/**
 * Class SqlInsert
 *
 * @package Picaso\Db
 */
class SqlInsert implements Sql
{

    /**
     * @var Connection
     */
    protected $_connection;
    /**
     * @var string
     */
    protected $_intoTable = null;
    /**
     * @var array
     */
    protected $_data = [];
    /**
     * @var bool
     */
    protected $_ignoreOnDuplicate = false;
    /**
     * @var bool
     */
    protected $_delay = false;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->_connection = $connection;
    }

    /**
     * @param      $tableName
     * @param null $data
     *
     * @return $this
     */
    public function insert($tableName, $data = null)
    {
        $this->_intoTable = (string)$tableName;

        if (!empty($data)) {
            $this->_data = $data;
        }

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function values($data)
    {
        $this->_data = $data;

        return $this;
    }

    /**
     * @param $flag
     *
     * @return $this
     */
    public function ignoreOnDuplicate($flag)
    {
        $this->_ignoreOnDuplicate = (bool)$flag;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isDelay()
    {
        return $this->_delay;
    }

    /**
     * @param $delay
     *
     * @return $this
     */
    public function setDelay($delay)
    {
        $this->_delay = $delay;

        return $this;
    }

    /**
     * @param null $sql
     *
     * @return mixed
     * @throws SqlException
     */
    public function execute($sql = null)
    {

        if (null == $sql) {
            $sql = $this->prepare();
        }

        $result = $this->_connection->exec($sql);

        if (false === $result) {
            throw new SqlException($this->_connection->getErrorMessage() . PHP_EOL . $sql);
        }

        return $result;
    }

    /**
     * @return string
     */
    public function prepare()
    {

        $keys = [];
        $values = [];
        foreach ($this->_data as $key => $value) {
            $keys [] = $key;
            $values[] = $this->_connection->quote($value);
        }

        $delay = $this->_delay ? ' DELAY ' : '';
        $ignore = $this->_ignoreOnDuplicate ? ' IGNORE ' : '';

        return 'INSERT ' . $delay . $ignore . ' INTO ' . $this->_intoTable . '(' . implode(', ', $keys) . ') VALUES (' . implode(', ', $values) . ')';
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->prepare();
    }
}