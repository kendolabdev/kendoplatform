<?php

namespace Picaso\Db;

/**
 * Interface Driver
 *
 * @package Picaso\Db
 */
interface Driver
{

    /**
     * @return Connection
     */
    public function getMaster();

    /**
     * @return Connection
     */
    public function getSlave();

    /**
     * @param bool $master
     *
     * @return Connection
     */
    public function getConnection($master = true);
}