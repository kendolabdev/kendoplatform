<?php

/**
 * @author  Nam Nguyen <namnv@younetco.com>
 * @version 1.0.1
 * @package Picaso
 */
namespace Picaso\Db;

/**
 * Interface Connection
 *
 * @package Picaso\Db
 */
interface Connection
{

    /**
     * @return array
     */
    public function info();

    /**
     * @param $string
     *
     * @return string
     */
    public function escape($string);

    /**
     * @param $sql
     *
     * @return mixed
     */
    public function exec($sql);

    /**
     * @param null $sql
     *
     * @return QueryResult
     */
    public function query($sql);

    /**
     * @param  $value
     *
     * @return mixed
     */
    public function quote($value);

    /**
     * @return string
     */
    public function getErrorMessage();

    /**
     * @return int
     */
    public function getErrorCode();

    /**
     * @return int
     */
    public function lastId();

    /**
     * @return SqlSelect
     */
    public function select();

    /**
     * @param string $table
     * @param array  $data
     *
     * @return SqlInsert
     * @throws SqlException
     */
    public function insert($table, $data);

    /**
     * @param string $table
     * @param array  $data
     *
     * @return SqlInsert
     * @throws SqlException
     */
    public function insertDelay($table, $data);

    /**
     * @param  $table
     * @param  $data
     *
     * @return SqlUpdate
     */
    public function update($table, $data);

    /**
     * describe table
     *
     * @param  string $table
     *
     * @return array
     */
    public function describe($table);

    /**
     * @param $table
     *
     * @return string
     */
    public function getCreateTableSql($table);

    /**
     * @return array [string, ]
     */
    public function tables();

}