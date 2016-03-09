<?php

namespace Kendo\Db;

use Kendo\Content\PosterInterface;

/**
 * Class Table
 *
 * @package Kendo\Db
 */
class DbTable
{

    /**
     * @var string
     */
    protected $identity = '';

    /**
     * @var array
     */
    protected $column = [];

    /**
     * @var null
     */
    protected $driver = null;

    /**
     * @var array
     */
    protected $primary = [];

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var string
     */
    protected $class = '\Kendo\Model';

    /**
     * @var array
     */
    protected $defaultValue = [];

    /**
     * @return string|false
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function insert($data)
    {
        return (new SqlInsert($this->getMaster()))
            ->insert($this->getName(), array_intersect_key($data, $this->getColumn()))
            ->execute();
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function insertIgnore($data)
    {
        $sql = (new SqlInsert($this->getMaster()))
            ->insert($this->getName(), array_intersect_key($data, $this->getColumn()))
            ->ignoreOnDuplicate(true);

        return $sql->execute();
    }

    /**
     * @return Connection
     */
    public function getMaster()
    {
        return app()->db()->getMaster($this->getDriver());
    }

    /**
     * @return array
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return app()->db()->getName($this->name);
    }

    /**
     * @return array
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * @return array
     */
    public function getDefault()
    {
        return $this->defaultValue;
    }

    /**
     * @param  array $data
     *
     * @return array (expression, condition)
     */
    public function getCondition($data)
    {

        $primaryData = array_intersect_key($data, $this->getPrimary());

        $expressionArray = [];
        $condition = [];

        foreach ($primaryData as $k => $v) {
            $expressionArray [] = "$k=:$k ";
            $condition [":$k"] = $v;
        }

        $expression = implode(' AND ', $expressionArray);

        return [$expression, $condition];
    }

    /**
     * @return array
     */
    public function getPrimary()
    {
        return $this->primary;
    }

    /**
     * @param $data
     * @param $update
     *
     * @return SqlUpdate
     */
    public function modifyColumns($data, $update)
    {
        $values = array_intersect_key($data, $this->getColumnNotPrimary());

        if (empty($values)) {
            return true;
        }

        $query = new SqlUpdate($this->getMaster());

        $query->update($this->getName(), $update);

        foreach ($this->getPrimary() as $column => $type) {
            $query->where("$column=?", $data[ $column ]);
        }

        return $query->execute();
    }

    /**
     * @return array
     */
    public function getColumnNotPrimary()
    {
        return array_diff_key($this->column, $this->primary);
    }

    /**
     * @param array $data
     * @param array $values
     *
     * @return mixed
     */
    public function updateModel($data, $values = null)
    {
        if (empty($values)) {
            $values = $data;
        }

        $values = array_intersect_key($values, $this->getColumnNotPrimary());

        if (empty($values)) {
            return true;
        }

        $query = new SqlUpdate($this->getMaster());

        $query->update($this->getName(), $values);

        foreach ($this->getPrimary() as $column => $type) {
            $query->where("$column=?", $data[ $column ]);
        }

        return $query->execute();
    }

    /**
     * @param array $values
     *
     * @return SqlUpdate
     */
    public function update($values)
    {
        return (new SqlUpdate($this->getMaster()))->update($this->getName(), $values);
    }

    /**
     * @param  array|null $data
     *
     * @return \Kendo\Model
     */
    public function fetchNew($data = null)
    {

        $class = $this->class;

        return new $class($data);
    }

    /**
     * @param string $alias
     *
     * @return SqlSelect
     *
     */
    public function select($alias = null)
    {
        if (null == $alias) {
            $alias = 't1';
        }

        return (new SqlSelect($this->getSlave()))->setModel($this->class)->from($this->getName(), $alias);
    }

    /**
     * @return Connection
     */
    public function getSlave()
    {
        return app()->db()->getSlave($this->getDriver());
    }

    /**
     * @param  array $data
     *
     * @return bool
     */
    public function deleteByModelData($data)
    {
        $sql = $this->delete();

        foreach ($this->getPrimary() as $column => $type) {
            $sql->where("$column=?", $data[ $column ]);
        }

        return $sql->execute();
    }

    /**
     * @return SqlDelete
     */
    public function delete()
    {
        return (new SqlDelete($this->getMaster()))->delete($this->getName());
    }

    /**
     * @param string $column
     * @param string $value
     * @param string $where
     *
     * @return bool
     */
    public function findAndModify($column, $value, $where)
    {
        return (new SqlUpdate($this->getMaster()))
            ->update($this->getName(), [
                $column => new SqlExpression($value)
            ])
            ->where($where)
            ->execute();


    }

    /**
     * This method must implement by child method
     *
     * @param  $value
     *
     * @return \Kendo\Model
     */
    public function findById($value)
    {

    }

    /**
     * @param array $value
     *
     * @return array
     */
    public function findByIdList($value)
    {

    }


    /**
     * @param PosterInterface $poster
     * @param string          $column
     * @param int             $value -1
     * @param int             $limit 500
     * @param \Closure        $getTypeList
     * @param \Closure        $getIdList
     * @param \Closure        $deleteClosure
     */
    public function partialUpdateWhenPosterRemove($poster, $column, $value, $limit, \Closure $getTypeList, \Closure $getIdList, \Closure $deleteClosure)
    {
        /**
         * how to process with hundred of thousand entry need to be delete?
         */
        foreach ($getTypeList() as $type) {
            $table = app()->table($type);
            $primary = $table->getPrimary();
            if (count($primary) > 0) continue;
            $primary = array_pop(array_keys($primary));

            while ($idList = $getIdList($type, $limit)) {

                if (empty($idList)) break;

                $table->update(["$column" => new SqlExpression("$column+($value)")])
                    ->where("$primary IN ?", $idList)
                    ->execute();

                $deleteClosure($idList);

                if (count($idList) < $limit) break;
            }
        }
    }
}