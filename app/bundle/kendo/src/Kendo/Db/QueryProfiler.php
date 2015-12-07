<?php

namespace Kendo\Db;

/**
 * Class QueryProfiler
 *
 * @package Kendo\Db
 */
class QueryProfiler
{
    /**
     * @var array
     */
    private $query = [];

    /**
     * @param string $sql
     */
    public function start($sql)
    {
        $this->query[] = $sql;
    }

    /**
     * end query token
     */
    public function end()
    {

    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->query;
    }

    /**
     * @return string
     */
    public function dump()
    {
        $result = [];

        foreach ($this->query as $item) {
            $result[] = sprintf('sql: %s', $item);
        }

        return implode(PHP_EOL, $result);
    }

    public function dumpHtml()
    {
        $result = [];

        foreach ($this->query as $item) {
            $result[] = sprintf('sql: %s', $item);
        }

        return implode('<br />', $result);
    }
}