<?php

/**
 * @author  Nam Nguyen <namnv@younetco.com>
 * @version 1.0.1
 * @package Picaso
 */

namespace Picaso\Db;

/**
 * Class SqlSelect
 *
 * @package Picaso\Db
 */
class SqlSelect implements Sql
{

    /**
     *
     */
    const COUNT_NAME = 'picaso_total_count';
    /**
     *
     */
    const LEFT_JOIN = 'LEFT JOIN';
    /**
     *
     */
    const JOIN = 'JOIN';
    /**
     *
     */
    const RIGHT_JOIN = 'RIGHT JOIN';
    /**
     * @var Connection
     */
    protected $_connection;

    /**
     * @var array
     */
    protected $_columns = [];

    /**
     * @var array
     */
    protected $_tables = [];

    /**
     * @var SqlCondition
     */
    protected $_where;

    /**
     * @var SqlCondition
     */
    protected $_having;

    /**
     * @var SqlJoin
     */
    protected $_join;

    /**
     * @var string
     */
    protected $_group;

    /**
     * @var int
     */
    protected $_limit = 0;

    /**
     * @var int
     */
    protected $_offset = 0;

    /**
     * @var string
     */
    protected $_order = '';

    /**
     * @var string
     */
    protected $_model = null;

    /**
     * @ignore
     *
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->_connection = $connection;
    }

    /**
     * @param string $table
     * @param null   $alias
     * @param null   $columns
     *
     * @return $this
     */
    public function from($table, $alias = null, $columns = null)
    {
        if (is_null($alias)) {
            $this->_tables[] = $table;
        } else {
            $this->_tables[] = $table . ' AS ' . (string)$alias;
        }

        if (!is_null($columns)) {
            $this->columns($columns);
        }

        return $this;
    }

    /**
     * @param array|string $columns
     *
     * @return $this
     */
    public function columns($columns)
    {
        if (is_string($columns)) {
            $this->_columns [] = $columns;
        } else if (is_array($columns)) {
            foreach ($columns as $col) {
                $this->_columns[] = $col;
            }
        }

        return $this;
    }

    /**
     * @param string $class
     *
     * @return SqlSelect
     */
    public function toClass($class)
    {
        $this->_model = $class;

        return $this;
    }

    /**
     * @param $expression
     * @param $data
     *
     * @return SqlSelect
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
     * @param $expression
     * @param $data
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
     * @param $expression
     * @param $data
     *
     * @return $this
     */
    public function having($expression, $data)
    {
        if (null == $this->_having) {
            $this->_having = new SqlCondition($this->_connection);
        }
        $this->_having->where($expression, $data);

        return $this;
    }

    /**
     * @param $expression
     * @param $data
     *
     * @return $this
     */
    public function orHaving($expression, $data)
    {
        if (null == $this->_having) {
            $this->_having = new SqlCondition($this->_connection);
        }
        $this->_having->where($expression, $data);

        return $this;
    }

    /**
     * @param int $page
     * @param int $limit
     *
     * @return \Picaso\Paging\PagingInterface
     */
    public function paging($page, $limit)
    {
        return \App::pagingService()->factory($this)->paging($page, $limit);
    }

    /**
     * @param $limit
     * @param $offset
     *
     * @return SqlSelect
     */
    public function limit($limit, $offset)
    {
        $this->_limit = (int)$limit;
        $this->_offset = (int)$offset;

        return $this;
    }

    /**
     * @param $columns
     *
     * @return $this
     */
    public function group($columns)
    {
        $this->_group = $columns;

        return $this;
    }

    /**
     * @param $table
     * @param $alias
     * @param $expression
     * @param $data
     * @param $columns
     *
     * @return $this
     */
    public function join($table, $alias, $expression, $data, $columns)
    {
        if (null == $this->_join) {
            $this->_join = new SqlJoin($this->_connection);
        }

        if (is_string($table) && substr($table, 0, 1) == ':')
            $table = \App::db()->getPrefix() . substr($table, 1);

        $this->_join->join(self::JOIN, $table, $alias, $expression, $data);

        if (null != $columns) {
            $this->columns($columns);
        }

        return $this;
    }

    /**
     * @param $table
     * @param $alias
     * @param $expression
     * @param $data
     * @param $columns
     *
     * @return $this
     */
    public function leftJoin($table, $alias, $expression, $data = null, $columns = null)
    {
        if (null == $this->_join) {
            $this->_join = new SqlJoin($this->_connection);
        }

        $this->_join->join(self::LEFT_JOIN, $table, $alias, $expression, $data);

        if (null != $columns) {
            $this->columns($columns);
        }

        return $this;
    }

    /**
     * @param $table
     * @param $alias
     * @param $expression
     * @param $data
     * @param $columns
     *
     * @return $this
     */
    public function rightJoin($table, $alias, $expression, $data, $columns)
    {
        if (null == $this->_join) {
            $this->_join = new SqlJoin($this->_connection);
        }

        $this->_join->join(self::LEFT_JOIN, $table, $alias, $expression, $data);

        if (null != $columns) {
            $this->columns($columns);
        }

        return $this;
    }

    /**
     * @param $column
     * @param $type
     *
     * @return $this
     */
    public function order($column, $type)
    {
        switch (true) {
            case $type == 'asc':
            case $type == 'ASC':
            case $type === 1:
            case $type === '1':
                $this->_order = $column . ' ASC';
                break;
            case $type == 'DESC':
            case $type == 'desc':
            case $type === -1:
            case $type === "-1":
                $this->_order = $column . ' DESC';
                break;
            case $type == null:
            default:
                $this->_order = $column;

        }

        return $this;
    }

    /**
     * @param null $sql
     *
     * @return int
     */
    public function count($sql = null)
    {
        if (null == $sql) {
            $sql = $this->prepareCount();
        }

        $result = $this->_connection->query($sql);

        return $result->toInt(self::COUNT_NAME);
    }

    /**
     * @return string
     */
    public function prepareCount()
    {
        $tables = implode(', ', $this->_tables);
        $where = empty($this->_where) ? '' : ' WHERE ' . $this->_where->prepare();
        $having = empty($this->_having) ? '' : ' HAVING ' . $this->_having->prepare();
        $join = empty($this->_join) ? '' : ' ' . $this->_join->prepare();
        $group = empty($this->_group) ? '' : ' GROUP BY ' . $this->_group;

        return 'SELECT count(*) as ' . self::COUNT_NAME . ' FROM ' . $tables . $join . $where . $group . $having;
    }

    /**
     * @param string $column
     * @param null   $sql
     *
     * @return array
     */
    public function toInts($column, $sql = null)
    {
        return $this->execute($sql)->toInts($column);
    }

    /**
     * @param null $sql
     *
     * @return QueryResult
     */
    public function execute($sql = null)
    {
        if (null == $sql) {
            $sql = $this->prepare();
        }

        $result = $this->_connection->query($sql);

        return $result;
    }

    /**
     * @return string
     */
    public function prepare()
    {
        $columns = empty($this->_columns) ? '*' : implode(', ', $this->_columns);
        $tables = implode(', ', $this->_tables);

        $where = empty($this->_where) ? '' : ' WHERE ' . $this->_where->prepare();
        $having = empty($this->_having) ? '' : ' HAVING ' . $this->_having->prepare();
        $join = empty($this->_join) ? '' : ' ' . $this->_join->prepare();

        $limit = empty($this->_limit) ? '' : ' LIMIT ' . $this->_offset . ', ' . $this->_limit;
        $group = empty($this->_group) ? '' : ' GROUP BY ' . $this->_group;
        $order = empty($this->_order) ? '' : ' ORDER BY ' . $this->_order;


        return 'SELECT ' . $columns . ' FROM ' . $tables . $join . $where . $group . $having . $order . $limit;
    }

    /**
     * @param string $column
     * @param null   $sql
     *
     * @return array
     */
    public function toInt($column, $sql = null)
    {
        return $this->execute($sql)->toInt($column);
    }

    /**
     * @param      $column
     * @param null $sql
     *
     * @return mixed
     */
    public function field($column, $sql = null)
    {
        return $this->execute($sql)->field($column);
    }

    /**
     * @param      $column
     * @param null $sql
     *
     * @return mixed
     */
    public function fields($column, $sql = null)
    {
        return $this->execute($sql)->fields($column);
    }


    /**
     * @param null $sql
     *
     * @return array
     */
    public function all($sql = null)
    {
        return $this->execute($sql)->setModel($this->_model)->all();
    }

    /**
     * @param null $sql
     *
     * @return mixed
     */
    public function one($sql = null)
    {
        return $this->execute($sql)->setModel($this->_model)->one();
    }

    /**
     * @param null $sql
     *
     * @return array
     */
    public function toAssoc($sql = null)
    {
        return $this->execute($sql)->setModel($this->_model)->toAssoc();
    }

    /**
     * @param null $sql
     *
     * @return array
     */
    public function toAssocs($sql = null)
    {
        return $this->execute($sql)->setModel($this->_model)->toAssocs();
    }

    /**
     * @param string $keyColumn
     * @param string $valueColumn
     * @param string $sql
     *
     * @return array
     */
    public function toPairs($keyColumn, $valueColumn, $sql = null)
    {
        return $this->execute($sql)->toPairs($keyColumn, $valueColumn);
    }

    /**
     * @param null $sql
     *
     * @return bool
     */
    public function exists($sql = null)
    {
        if (null == $sql) {
            $sql = $this->prepareExists();
        }

        $result = $this->_connection->query($sql);

        return $result->one() != null;
    }

    /**
     * @return string
     */
    public function prepareExists()
    {

        $columns = empty($this->_columns) ? '*' : implode(', ', $this->_columns);
        $tables = implode(', ', $this->_tables);

        $where = empty($this->_where) ? '' : ' WHERE ' . $this->_where->prepare();
        $having = empty($this->_having) ? '' : ' HAVING ' . $this->_having->prepare();
        $join = empty($this->_join) ? '' : ' ' . $this->_join->prepare();

        $limit = ' LIMIT 0, 1';
        $group = empty($this->_group) ? '' : ' GROUP BY ' . $this->_group;


        return 'SELECT ' . $columns . ' FROM ' . $tables . $join . $where . $group . $having . $limit;
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
    public function getModel()
    {
        return $this->_model;
    }

    /**
     * @param string $model Model class name
     *
     * @return SqlSelect
     */
    public function setModel($model)
    {
        $this->_model = $model;

        return $this;
    }

    /**
     * @return Connection
     */
    public function getConnection()
    {
        return $this->_connection;
    }

    /**
     * @param Connection $connection
     */
    public function setConnection($connection)
    {
        $this->_connection = $connection;
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        return $this->_columns;
    }

    /**
     * @param array $columns
     */
    public function setColumns($columns)
    {
        $this->_columns = $columns;
    }

    /**
     * @return array
     */
    public function getTables()
    {
        return $this->_tables;
    }

    /**
     * @param array $tables
     */
    public function setTables($tables)
    {
        $this->_tables = $tables;
    }

    /**
     * @return SqlCondition
     */
    public function getWhere()
    {
        return $this->_where;
    }

    /**
     * @param SqlCondition $where
     */
    public function setWhere($where)
    {
        $this->_where = $where;
    }

    /**
     * @return SqlCondition
     */
    public function getHaving()
    {
        return $this->_having;
    }

    /**
     * @param SqlCondition $having
     */
    public function setHaving($having)
    {
        $this->_having = $having;
    }

    /**
     * @return SqlJoin
     */
    public function getJoin()
    {
        return $this->_join;
    }

    /**
     * @param SqlJoin $join
     */
    public function setJoin($join)
    {
        $this->_join = $join;
    }

    /**
     * @return string
     */
    public function getGroup()
    {
        return $this->_group;
    }

    /**
     * @param string $group
     */
    public function setGroup($group)
    {
        $this->_group = $group;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->_limit;
    }

    /**
     * @param int $limit
     */
    public function setLimit($limit)
    {
        $this->_limit = $limit;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->_offset;
    }

    /**
     * @param int $offset
     */
    public function setOffset($offset)
    {
        $this->_offset = $offset;
    }

    /**
     * @return string
     */
    public function getOrder()
    {
        return $this->_order;
    }

    /**
     * @param string $order
     */
    public function setOrder($order)
    {
        $this->_order = $order;
    }
}