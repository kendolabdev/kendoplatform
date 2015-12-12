<?php

namespace Kendo\Db;

/**
 * Interface Sql
 *
 * @package Kendo\Db
 */
interface Sql
{

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection);

    /**
     * @return string
     */
    public function __toString();

    /**
     * @return string
     */
    public function prepare();
}