<?php

namespace Kendo\Db;

/**
 * Class SqlCondition
 *
 * @package Kendo\Db
 */
class SqlCondition implements Sql
{

    /**
     * @var Connection
     */
    protected $_connection;

    /**
     * @var array
     */
    protected $_where = [];

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->_connection = $connection;
    }

    /**
     * @param      $expression
     * @param null $value
     *
     * @return $this
     */
    public function where($expression, $value = null)
    {
        $this->_where(' AND ', $expression, $value);

        return $this;
    }

    /**
     * @param      $type
     * @param      $expression
     * @param null $value
     *
     * @return $this
     */
    protected function _where($type, $expression, $value = null)
    {
        $str = null;

        if (is_null($value)) {
            $str = str_replace('?', 'NULL', $expression);
        } else if (is_array($value)) {
            $str = strtr($expression, $this->quoteArray($value));
        } else if ($value instanceof SqlExpression) {
            $str = $value->getExpression();
        } else {
            $str = str_replace('?', $this->_connection->quote($value), $expression);
        }

        $this->_where [] = [$type, $str];

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

        // check first key


        if (is_numeric(array_keys($values)[0])) {
            foreach ($values as $k => $v) {
                $result[ $k ] = $this->_connection->quote($v);
            }

            return ['?' => '(' . implode(',', $result) . ')'];
        } else {
            foreach ($values as $k => $v) {
                $result[ $k ] = $this->_connection->quote($v);
            }
        }

        return $result;

    }

    /**
     * @param $expression
     * @param $value
     *
     * @return SqlCondition
     */
    public function orWhere($expression, $value)
    {
        return $this->_where(' OR ', $expression, $value);
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

        $result = '';

        foreach ($this->_where as $item) {
            list($type, $express) = $item;

            if ($result == '') {
                $result = ' (' . $express . ') ';
            } else {
                $result .= $type . ' (' . $express . ') ';
            }
        }

        if ('' == $result) {
            $result = ' 1 ';
        }

        return $result;
    }
}