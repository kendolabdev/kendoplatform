<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_attribute_plugin`
 */

namespace Platform\Catalog\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class AttributePluginTable
 *
 * @package Attribute\Model
 */
class AttributePluginTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `kendo_attribute_plugin`
     * @var string
     */
    protected $class = '\Attribute\Model\AttributePlugin';

    /**
     * @var string
     */
    protected $name = 'attribute_plugin';

    /**
     * @var array
     */
    protected $column = [
        'plugin_id'       => 1,
        'plugin_name'     => 1,
        'is_predefined'   => 1,
        'is_form_control' => 1,
        'plugin_setting'  => 1,
        'is_multiple'     => 1,
        'module_name'     => 1];

    /**
     * @var array
     */
    protected $primary = ['plugin_id' => 1];

    /**
     * @var string
     */
    protected $identity = '';


    /**
     * @param  string|int $value
     *
     * @return \Platform\Catalog\Model\AttributePlugin
     */
    public function findById($value)
    {
        return $this->select()
            ->where('plugin_id=?', $value)
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
            ->where('plugin_id IN ?', $value)
            ->all();
    }

    //END_TABLE_GENERATOR
}