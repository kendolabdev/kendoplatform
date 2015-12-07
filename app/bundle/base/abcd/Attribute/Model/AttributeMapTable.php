<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_attribute_map`
 */

namespace Attribute\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class AttributeMapTable
 * @package Attribute\Model
 */
class AttributeMapTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_attribute_map`
     * @var string
     */
    protected $class =  '\Attribute\Model\AttributeMap';

    /**
     * @var string
     */
    protected $name =  'attribute_map';

    /**
     * @var array
     */
    protected $column = array(
		'map_id'=>1,
		'section_id'=>1,
		'field_id'=>1,
		'sort_order'=>1,
		'is_active'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'map_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'map_id';

    
    /**
     * @param  string|int $value
     * @return \Attribute\Model\AttributeMap
     */
    public function findById($value){
       return $this->select()
           ->where('map_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('map_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}