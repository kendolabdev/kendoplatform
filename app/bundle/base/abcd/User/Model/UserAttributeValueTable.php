<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_user_attribute_value`
 */

namespace User\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class UserAttributeValueTable
 * @package User\Model
 */
class UserAttributeValueTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_user_attribute_value`
     * @var string
     */
    protected $class =  '\User\Model\UserAttributeValue';

    /**
     * @var string
     */
    protected $name =  'user_attribute_value';

    /**
     * @var array
     */
    protected $column = array(
		'id'=>1,
		'item_id'=>1,
		'field_id'=>1,
		'value'=>1,
		'value_int'=>1,
		'value_text'=>1,
		'value_date'=>1,
		'value_decimal'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'id'=>1);

    /**
     * @var string
     */
    protected $identity = 'id';

    
    /**
     * @param  string|int $value
     * @return \User\Model\UserAttributeValue
     */
    public function findById($value){
       return $this->select()
           ->where('id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}