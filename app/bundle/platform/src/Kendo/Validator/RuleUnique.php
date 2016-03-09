<?php
namespace Kendo\Validator;

/**
 * Class RuleUnique
 *
 * @package Kendo\Validator
 */
class RuleUnique extends Rule
{

    /**
     * @var string
     */
    protected $message = 'core.rule_unique';

    /**
     * @var string
     */
    protected $tableName;

    /**
     * @var string
     */
    protected $columnName;

    /**
     * @return bool
     */
    public function validate()
    {
        $value = $this->getValue();

        if (!$this->getTableName() || !$this->getColumnName()) {
            return true;
        }

        $table = app()->table($this->getTableName());

        $column = $this->getColumnName();

        $item = $table->select()
            ->where("$column=?", $value)
            ->one();

        if (null == $item) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @param string $tableName
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     * @return string
     */
    public function getColumnName()
    {
        return $this->columnName;
    }

    /**
     * @param string $columnName
     */
    public function setColumnName($columnName)
    {
        $this->columnName = $columnName;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return app()->text($this->message, ['$value' => $this->getValue()]);
    }
}