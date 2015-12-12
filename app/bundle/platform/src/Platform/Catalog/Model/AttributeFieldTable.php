<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_attribute_field`
 */

namespace Platform\Catalog\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class AttributeFieldTable
 *
 * @package Attribute\Model
 */
class AttributeFieldTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `kendo_attribute_field`
     * @var string
     */
    protected $class = '\Attribute\Model\AttributeField';

    /**
     * @var string
     */
    protected $name = 'attribute_field';

    /**
     * @var array
     */
    protected $column = [
        'field_id'    => 1,
        'field_code'  => 1,
        'content_id'  => 1,
        'field_name'  => 1,
        'plugin_id'   => 1,
        'params_text' => 1];

    /**
     * @var array
     */
    protected $primary = ['field_id' => 1];

    /**
     * @var string
     */
    protected $identity = 'field_id';


    /**
     * @param  string|int $value
     *
     * @return \Platform\Catalog\Model\AttributeField
     */
    public function findById($value)
    {
        return $this->select()
            ->where('field_id=?', $value)
            ->one();
    }

    /**
     * @param  array $value
     *
     * @return array
     */
    public function findByIdList($value)
    {
        return $this->select()
            ->where('field_id IN ?', $value)
            ->all();
    }

    //END_TABLE_GENERATOR
}