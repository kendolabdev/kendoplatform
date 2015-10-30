<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_core_profile_field`
 */

namespace Core\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class CoreProfileFieldTable
 * @package Core\Model
 */
class CoreProfileFieldTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_core_profile_field`
     * @var string
     */
    protected $class =  '\Core\Model\CoreProfileField';

    /**
     * @var string
     */
    protected $name =  'core_profile_field';

    /**
     * @var array
     */
    protected $column = array(
		'field_id'=>1,
		'content_type'=>1,
		'field_name'=>1,
		'plugin_id'=>1,
		'is_required'=>1,
		'is_multiple'=>1,
		'data_type'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'field_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'field_id';

    
    /**
     * @param  string|int $value
     * @return \Core\Model\CoreProfileField
     */
    public function findById($value){
       return $this->select()
           ->where('field_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('field_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}