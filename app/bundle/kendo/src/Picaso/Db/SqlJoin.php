<?php

/**
 * @author  Nam Nguyen <namnv@younetco.com>
 * @version 1.0.1
 * @package Picaso
 */
namespace Picaso\Db;

/**
 * Class SqlJoin
 *
 * @package Picaso\Db
 */
class SqlJoin implements Sql
{

    /**
     * @var Connection
     */
    protected $_connection;

    /**
     * @var array
     */
    protected $_elements = [];

    /**
     * @param $connection
     */
    public function __construct(Connection $connection)
    {
        $this->_connection = $connection;
    }

    /**
     * @param $type
     * @param $table
     * @param $alias
     * @param $expression
     * @param $value
     *
     * @return $this
     */
    public function join($type, $table, $alias, $expression, $value)
    {

        $condition = null;

        if (is_null($value)) {
            $condition = $expression;
        } else if (is_array($value)) {
            $condition = strtr($expression, $this->quoteArray($value));
        } else {
            $condition = str_replace('?', $this->_connection->quote($value), $expression);
        }

        $this->_elements[] = $type . ' ' . $table . ' AS ' . $alias . ' ON (' . $condition . ') ';

        return $this;
    }

    /**
     * @param array $values
     *
     * @return array
     */
    protected function quoteArray(array $values)
    {
        $result = [];

        foreach ($values as $k => $v) {
            $result[ $k ] = $this->_connection->quote($v);
        }

        return $result;

    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->prepare();
    }

    /**
     * @return string
     */
    public function prepare()
    {
        return implode(' ', $this->_elements);
    }
}