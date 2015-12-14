<?php

/**
 * @author  Nam Nguyen <namnv@younetco.com>
 * @version 1.0.1
 * @package Kendo
 */

namespace Kendo\Db;

use mysqli;

/**
 * Class ConnectionMysqli
 *
 * @package Kendo\Db
 */
class ConnectionMysqli implements Connection
{
    /**
     * @var \mysqli
     */
    protected $connection;

    /**
     * @param $params
     *
     * @throws Exception
     */
    public function __construct($params)
    {
        $params = array_merge([
            'host'     => 'localhost',
            'port'     => 3306,
            'database' => null,
            'user'     => null,
            'password' => null,
            'socket'   => null,
            'charset'  => 'utf8',
        ], $params);

        $host = $params['host'];
        $port = $params['port'];
        $user = $params['user'];
        $password = $params['password'];
        $database = $params['database'];
        $socket = $params['socket'];
        $charset = $params['charset'];

        $this->connection = new \mysqli($host, $user, $password, $database, $port, $socket);

        if (empty($this->connection)) {
            throw new \RuntimeException('Could not connect database');
        }

        if ($this->connection->connect_errno) {
            $msg = strtr('Db connection error #:number: :msg', [
                ':number' => $this->connection->connect_errno,
                ':msg'    => $this->connection->connect_error,
            ]);
            throw new Exception($msg);
        }

        // set correct charset
        $this->connection->set_charset($charset);
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function quote($value)
    {
        switch (true) {
            case is_null($value):
                return 'NULL';
            case is_array($value):
                return implode(', ', array_map([$this, 'quote'], $value));
            case is_string($value):
                return '\'' . $this->escape($value) . '\'';
            default:
                return $value;
        }
    }

    /**
     * @param $string
     *
     * @return string
     */
    public function escape($string)
    {
        return $this->connection->real_escape_string($string);
    }

    /**
     * @return array
     */
    public function info()
    {
        return [
            'host'     => $this->connection->host_info,
            'protocol' => $this->connection->protocol_version,
        ];
    }

    /**
     * @param  string $sql
     *
     * @return mixed
     */
    public function exec($sql)
    {

        return $this->connection->query($sql);
    }

    /**
     * @param $table
     *
     * @return string
     */
    public function getCreateTableSql($table)
    {
        $result = $this->exec("SHOW CREATE TABLE `" . $table . "`");

        $row = mysqli_fetch_array($result, MYSQLI_BOTH);

        return $row[1];
    }

    /**
     * Describe table
     *
     * @param  string $table
     *
     * @return array
     */
    public function describe($table)
    {

        $result = $this->query('describe ' . $table)->all();

        $primary = [];
        $column = [];
        $identity = '';

        foreach ($result as $row) {
            $column[ $row['Field'] ] = 1;

            if (strtolower($row['Key']) == 'pri') {
                $primary[ $row['Field'] ] = 1;
            }

            if (strtolower($row['Extra']) == 'auto_increment') {
                $identity = $row['Field'];
            }
        }

        return [
            'column'   => $column,
            'identity' => $identity,
            'primary'  => $primary,
            'name'     => $table,
        ];
    }

    /**
     * @param null $sql
     *
     * @return QueryResultMysqli
     * @throws SqlException
     */
    public function query($sql)
    {

        if (KENDO_DEBUG)
            \App::queryProfiler()->bound($sql);

        $result = $this->connection->query($sql);

        if (KENDO_DEBUG)
            \App::queryProfiler()->end();

        if (false === $result) {
            throw new SqlException($this->getErrorMessage() . PHP_EOL . $sql);
        }

        if (null === $result) {
            throw new SqlException($this->getErrorMessage() . PHP_EOL . $sql);
        }

        return new QueryResultMysqli($result);
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->connection->error;
    }

    /**
     * @return int
     */
    public function lastId()
    {
        return (int)$this->connection->insert_id;
    }

    /**
     * @return int
     */
    public function getErrorCode()
    {
        return $this->connection->errno;
    }

    /**
     * @param string $table
     * @param array  $data
     *
     * @return SqlInsert
     * @throws SqlException
     */
    public function insert($table, $data)
    {
        return (new SqlInsert($this))->insert($table, $data);
    }

    /**
     * @param string $table
     * @param array  $data
     *
     * @return SqlInsert
     * @throws SqlException
     */
    public function insertDelay($table, $data)
    {
        return (new SqlInsert($this))->insert($table, $data)->setDelay(true);
    }

    /**
     * @return SqlSelect
     */
    public function select()
    {
        return new SqlSelect($this);
    }

    /**
     * @param  $table
     * @param  $data
     *
     * @return SqlUpdate
     */
    public function update($table, $data)
    {
        return (new SqlUpdate($this))->update($table, $data);
    }

    /**
     * @return array [string, ]
     */
    public function tables()
    {
        $result = $this->connection->query('show tables');

        $response = [];

        while (null != ($row = mysqli_fetch_array($result))) {
            $response[] = $row[0];
        }

        return $response;
    }

}