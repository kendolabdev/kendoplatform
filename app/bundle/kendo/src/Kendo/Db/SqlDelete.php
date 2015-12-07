<?php

/**
 * @author  Nam Nguyen <namnv@younetco.com>
 * @version 1.0.1
 * @package Kendo
 */
namespace Kendo\Db;

/**
 * Class SqlDelete
 *
 * @package Kendo\Db
 */
class SqlDelete implements Sql
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
     * @param $table
     *
     * @return $this
     */
    public function delete($table)
    {
        $this->_tableName = $table;

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
     * @throws SqlException
     */
    public function execute($sql = null)
    {
        if (null == $sql) {
            $sql = $this->prepare();
        }

        $result = $this->_connection->exec($sql);

        if (false === $result) {
            throw new SqlException($this->_connection->getErrorMessage());
        }

        return $result;
    }

    /**
     * @return string
     */
    public function prepare()
    {
        $where = empty($this->_where) ? '' : ' WHERE ' . $this->_where->prepare();

        return 'DELETE FROM ' . $this->_tableName . $where;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->prepare();
    }
}