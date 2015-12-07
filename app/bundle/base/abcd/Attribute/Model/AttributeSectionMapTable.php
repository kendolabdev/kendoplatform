<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_attribute_section_map`
 */

namespace Attribute\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class AttributeSectionMapTable
 * @package Attribute\Model
 */
class AttributeSectionMapTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_attribute_section_map`
     * @var string
     */
    protected $class =  '\Attribute\Model\AttributeSectionMap';

    /**
     * @var string
     */
    protected $name =  'attribute_section_map';

    /**
     * @var array
     */
    protected $column = array(
		'map_id'=>1,
		'catalog_id'=>1,
		'section_id'=>1,
		'sort_order'=>1);

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
     * @return \Attribute\Model\AttributeSectionMap
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