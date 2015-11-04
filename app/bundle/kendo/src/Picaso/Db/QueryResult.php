<?php

/**
 *
 * User: namnv
 * Date: 4/13/15
 * Time: 6:45 PM
 */
namespace Picaso\Db;

/**
 * Interface QueryResult
 *
 * @package Picaso\Db
 */
interface QueryResult
{
    /**
     * @param string $class
     *
     * @return QueryResult
     */
    public function setModel($class);

    /**
     * @return string $class
     */
    public function getModel();

    /**
     * @return array
     */
    public function all();

    /**
     * @return mixed
     */
    public function one();

    /**
     * @param  string $column
     *
     * @return int
     */
    public function toInt($column);

    /**
     * @param  string $column
     *
     * @return int
     */
    public function toInts($column);

    /**
     * @return array [key: value]
     */
    public function toAssoc();

    /**
     * @return array [[ key: value], .. ]
     */
    public function toAssocs();

    /**
     * @param string $column
     *
     * @return string
     */
    public function field($column);

    /**
     * @param $column
     *
     * @return array
     */
    public function fields($column);

    /**
     * @param string $keyColumn
     * @param string $valueColumn
     *
     * @return array
     */
    public function toPairs($keyColumn, $valueColumn);

}