<?php

/**
 * @author   Nam Nguyen <namnv@younetco.com>
 * @version  1.0.1
 * @catehory Kendo
 * @package  Kendo
 * @date $date
 */

namespace Kendo\Content;
use Kendo\Kernel\DbUniqueIdGenerator;
use Kendo\Kernel\KernelServiceAgreement;
use Kendo\Kernel\UniqueIdGeneratorInterface;

/**
 * Class Manager
 *
 * @package Kendo\Content
 */
class Manager extends KernelServiceAgreement
{
    const MIN_NEXT_ID = 1000;

    /**
     * @var bool
     */
    private $loaded = false;

    /**
     * @var array
     */
    protected $tables = [
        'platform_core_extension' => '\Platform\Core\Model\CoreExtensionTable',
        'platform_core_hook'      => '\Platform\Core\Model\CoreHookTable',
        'platform_core_type'      => '\Platform\Core\Model\CoreTypeTable',
    ];

    /**
     * @var UniqueIdGeneratorInterface
     */
    protected $idGenerator;

    /**
     * @ingore
     */
    public function __construct()
    {
    }

    /**
     * @return boolean
     */
    public function isLoaded()
    {
        return $this->loaded;
    }

    /**
     * @param boolean $loaded
     */
    public function setLoaded($loaded)
    {
        $this->loaded = $loaded;
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
     *
     */
    protected function load()
    {

        if ($this->isLoaded())
            return;

        $this->tables = \App::table('platform_core_type')
            ->select()
            ->toPairs('type_id', 'table_name');

        $this->setLoaded(true);
    }

    /**
     * Caculate model class & Table class of specific entity type.
     *
     * @param $alias
     */
    public function fill($alias)
    {
        if (false == $this->isLoaded()) {
            $this->load();
        }

        $model = null;

        if (isset($this->tables[ $alias ])) {

        } else {
            if (false === strpos($alias, '.')) {
                $upcase = ucfirst($alias);
                $model = "\\{$upcase}\\Model\\{$upcase}";
            } else {
                $model = '\\' . str_replace(' ', '', ucwords(str_replace(['.', '_'], ['\Model\ ', ' '], $alias)));
            }

            $this->tables[ $alias ] = $model . 'Table';
        }
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
     * @return UniqueIdGeneratorInterface
     */
    public function getIdGenerator()
    {
        if (null == $this->idGenerator) {
            $this->idGenerator = new DbUniqueIdGenerator();
        }

        return $this->idGenerator;
    }
}