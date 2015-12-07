<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_attribute_option`
 */

namespace Attribute\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class AttributeOptionTable
 * @package Attribute\Model
 */
class AttributeOptionTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_attribute_option`
     * @var string
     */
    protected $class =  '\Attribute\Model\AttributeOption';

    /**
     * @var string
     */
    protected $name =  'attribute_option';

    /**
     * @var array
     */
    protected $column = array(
		'option_id'=>1,
		'field_id'=>1,
		'option_name'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'option_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'option_id';

    
    /**
     * @param  string|int $value
     * @return \Attribute\Model\AttributeOption
     */
    public function findById($value){
       return $this->select()
           ->where('option_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('option_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}