<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_attribute_field_map`
 */

namespace Attribute\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class AttributeFieldMapTable
 * @package Attribute\Model
 */
class AttributeFieldMapTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_attribute_field_map`
     * @var string
     */
    protected $class =  '\Attribute\Model\AttributeFieldMap';

    /**
     * @var string
     */
    protected $name =  'attribute_field_map';

    /**
     * @var array
     */
    protected $column = array(
		'map_id'=>1,
		'section_id'=>1,
		'field_id'=>1,
		'sort_order'=>1,
		'ext_params_text'=>1);

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
     * @return \Attribute\Model\AttributeFieldMap
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