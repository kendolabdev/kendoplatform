<?php

namespace Picaso\Db;

/**
 * Interface Sql
 *
 * @package Picaso\Db
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