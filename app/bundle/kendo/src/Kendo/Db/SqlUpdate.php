<?php

/**
 * @author  Nam Nguyen <namnv@younetco.com>
 * @version 1.0.1
 * @package Kendo
 */

namespace Kendo\Db;

/**
 * Class SqlUpdate
 *
 * @package Kendo\Db
 */
class SqlUpdate implements Sql
{

    /**
     * @var Connection
     */
    protected $_connection;

    /**
     * @var string
     */
    protected $_tableName;

    /**
     * @var array
     */
    protected $_data = [];

    /**
     * @var SqlCondition
     */
    protected $_where = null;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->_connection = $connection;
    }

    /**
     * @param string $tableName
     * @param array  $data
     *
     * @return $this
     */
    public function update($tableName, $data)
    {
        $this->_tableName = $tableName;
        $this->_data = $data;

        return $this;
    }

    /**
     * @param      $expression
     * @param null $data
     *
     * @return $this
     */
    public function where($expression, $data = null)
    {
        if (null == $this->_where) {
            $this->_where = new SqlCondition($this->_connection);
        }

        $this->_where->where($expression, $data);

        return $this;
    }

    /**
     * @param      $expression
     * @param null $data
     *
     * @return $this
     */
    public function orWhere($expression, $data = null)
    {
        if (null == $this->_where) {
            $this->_where = new SqlCondition($this->_connection);
        }

        $this->_where->orWhere($expression, $data);

        return $this;
    }

    /**
     * @param null $sql
     *
     * @return mixed
     * @throws Exception
     */
    public function execute($sql = null)
    {
        if (null == $sql) {
            $sql = $this->prepare();
        }

        $result = $this->_connection->exec($sql);


        if (false === $result) {
            throw new Exception($sql . $this->_connection->getErrorMessage());
        }

        return $result;
    }

    /**
     * @return string
     */
    public function prepare()
    {

        $array = [];

        foreach ($this->_data as $key => $value) {
            $array [] = $key . '=' . $this->_connection->quote($value);
        }

        $where = empty($this->_where) ? '' : ' WHERE ' . $this->_where->prepare();

        return 'UPDATE ' . $this->_tableName . ' SET ' . implode(', ', $array) . $where;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->prepare();
    }
}