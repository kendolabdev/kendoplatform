<?php
/**
 * @author  Nam Nguyen <namnv@younetco.com>
 * @version 1.0.1
 * @package Kendo
 */
namespace Kendo;

use Kendo\Content\UniqueId;
use Kendo\Db\SqlExpression;

/**
 * Class Model
 *
 * @package Kendo
 */
class Model
{
    /**
     * @var bool
     */
    protected $_saved = false;

    /**
     * Loaded data array
     *
     * @var array
     */
    protected $_data = [];

    /**
     * Modified columns
     *
     * @var array
     */
    protected $_modified = [];

    /**
     * @var string
     */
    protected $_signalGroup;

    /**
     * @var string
     */
    protected $_signalKey;

    /**
     * @ignore
     *
     * @param array $data
     * @param bool  $saved
     */
    public function __construct($data = null, $saved = false)
    {
        if (!empty($data)) {
            $this->_data = $data;
        }

        // set is saved
        $this->setSaved($saved);
    }

    /**
     * @param array
     */
    public function setFromArray($array)
    {
        foreach ($array as $property => $value) {
            if ('_' != substr($property, 0, 1)) {
                $this->__set($property, $value);
            }
        }
    }

    /**
     * @ignore
     * Call delete to remove entity from storage immediately.
     * @return bool
     */
    public function delete()
    {
        $this->_beforeDelete();
        $this->_delete();
        $this->_afterDelete();
    }

    /**
     * @ignore
     * Before delete trigger
     */
    protected function _beforeDelete()
    {
        if ($this->_signalGroup)
            \App::hookService()
                ->notify('onBeforeDelete' . $this->_signalGroup, $this);

        if ($this->_signalKey)
            \App::hookService()
                ->notify('onBeforeDelete' . $this->_signalKey, $this);

    }

    /**
     * @ignore
     * Call delete to remove entity from storage immediately.
     * @return bool
     */
    protected function _delete()
    {
        $this->table()->deleteByModelData($this->_data);

        return true;
    }

    /**
     * @return \Kendo\Db\DbTable
     */
    public function table()
    {
    }

    /**
     * @ignore
     */
    protected function _afterDelete()
    {
        if ($this->_signalGroup)
            \App::hookService()
                ->notify('onAfterDelete' . $this->_signalGroup, $this);

        if ($this->_signalKey)
            \App::hookService()
                ->notify('onAfterDelete' . $this->_signalKey, $this);
    }

    /**
     * call refresh to pull value from database immediately.
     */
    public function refresh()
    {

    }

    /**
     * Insert or Update entity to database
     *
     * @return bool
     */
    public function save()
    {
        if ($this->isSaved()) {
            $this->_beforeUpdate();
            $this->_update();
            $this->_afterUpdate();
        } else {
            $this->_beforeInsert();
            if ($this->_insert()) {
                $this->_afterInsert();
            }
        }
        $this->setSaved(true);
    }

    /**
     * @return boolean
     */
    public function isSaved()
    {
        return $this->_saved;
    }

    /**
     * @param boolean $saved
     */
    public function setSaved($saved)
    {
        $this->_saved = $saved;
    }

    /**
     * @ignore
     */
    protected function _beforeUpdate()
    {

    }

    /**
     * @ignore
     */
    protected function _update()
    {
        $this->table()->updateModel($this->_data);

        return true;
    }

    /**
     * @ignore
     */
    protected function _afterUpdate()
    {

    }

    /**
     * @ignore
     */
    protected function _beforeInsert()
    {
        if ($this instanceof UniqueId) {
            if (!$this->getId()) {
                $this->setId(\App::contentService()->nextId());
            }
        }

        if ($this->_signalGroup)
            \App::hookService()
                ->notify('onBeforeInsert' . $this->_signalGroup, $this);

        if ($this->_signalKey)
            \App::hookService()
                ->notify('onBeforeInsert' . $this->_signalKey, $this);
    }

    /**
     * @ignore
     *
     * @return bool
     */
    protected function _insert()
    {
        $table = $this->table();

        $result = $table->insert($this->_data);

        if ($result && null != ($col = $table->getIdentity()) && !$this->__get($col)) {
            $this->__set($col, $table->getMaster()->lastId());
        }

        return $result;
    }

    /**
     * Insert ignore
     *
     * @return bool
     */
    public function insertIgnore()
    {
        $table = $this->table();

        $table->insert($this->_data);

        if (null != ($col = $table->getIdentity()) && !$this->__get($col)) {
            $this->__set($col, $table->getMaster()->lastId());
        }

        return true;
    }

    /**
     * @ignore
     * \Core\Serive\PlistService::addRelationList($ownerId, $ownerType, $listType, $listName, $itemCount = 0)
     * \Core\Serive\PlistService::addItem($listId, $itemId, $itemType)
     */
    protected function _afterInsert()
    {

        if ($this->_signalGroup)
            \App::hookService()
                ->notify('onAfterInsert' . $this->_signalGroup, $this);

        if ($this->_signalKey)
            \App::hookService()
                ->notify('onAfterInsert' . $this->_signalKey, $this);
    }

    /**
     * @ignore
     * Override magic method
     *
     * @param $name
     *
     * @return string
     */
    public function __get($name)
    {
        return isset($this->_data[ $name ]) ? $this->_data[ $name ] : null;
    }

    /**
     * @ignore
     * Override magic method
     *
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->_data[ $name ] = $value;
        $this->_modified[ $name ] = 1;
    }

    /**
     * @ignore
     */
    protected function _refresh()
    {
        $this->_modified = [];
    }

    /**
     * @return array|null
     */
    public function toArray()
    {
        return $this->_data;
    }

    /**
     * @param $column
     * @param $value
     *
     * @return bool
     */
    public function modify($column, $value)
    {
        $this->table()->updateModel($this->_data, [$column => new SqlExpression($value)]);
    }

    /**
     *
     */
    public function toSimpleAttrs()
    {
        return [
            'id'   => $this->getId(),
            'type' => $this->getType(),
        ];
    }
}