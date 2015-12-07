<?php

/**
 * @author   Nam Nguyen <namnv@younetco.com>
 * @version  1.0.1
 * @catehory Kendo
 * @package  Kendo
 * @date $date
 */

namespace Kendo\Content;

/**
 * Class Manager
 *
 * @package Kendo\Content
 */
class Manager
{
    const MIN_NEXT_ID = 1000;

    /**
     * @var array
     */
    protected $models = [];

    /**
     * @var array
     */
    protected $tables = [];

    /**
     * @var UniqueIdInterface
     */
    protected $idGenerator;

    /**
     * @ingore
     */
    public function __construct()
    {
    }

    /**
     * @param $alias
     * @param $model
     * @param $table
     *
     * @return $this
     */
    public function register($alias, $model, $table)
    {
        $this->models[ $alias ] = $model;
        $this->tables[ $alias ] = $table;

        return $this;
    }

    /**
     * @param string $alias Alias is always in lower case directory is follow by "." and upercase is leaded by "_"
     *                      <br/> Excample: "user.user_role", "blog.entry", "activity.feed"
     *
     * @return \Kendo\Db\DbTable
     */
    public function getTable($alias)
    {
        if (!isset($this->tables[ $alias ])) {
            $this->fill($alias);
        }

        return \App::db()->getTable($this->tables[ $alias ]);
    }

    /**
     * Caculate model class & Table class of specific entity type.
     *
     * @param $alias
     */
    public function fill($alias)
    {
        $model = null;

        if (false === strpos($alias, '.')) {
            $upcase = ucfirst($alias);
            $model = "\\{$upcase}\\Model\\{$upcase}";
        } else {
            $model = '\\' . str_replace(' ', '', ucwords(str_replace(['.', '_'], ['\Model\ ', ' '], $alias)));
        }

        $this->models[ $alias ] = $model;
        $this->tables[ $alias ] = $model . 'Table';
    }

    /**
     * @return int
     */
    public function nextId()
    {
        $nextId = $this->getIdGenerator()->nextId();

        if ($nextId < self::MIN_NEXT_ID) {
            $this->getIdGenerator()->setNextId(self::MIN_NEXT_ID);
        }

        return $nextId;
    }

    /**
     * @return UniqueIdInterface
     */
    public function getIdGenerator()
    {
        if (null == $this->idGenerator) {
            $this->idGenerator = new DbUniqueId();
        }

        return $this->idGenerator;
    }
}