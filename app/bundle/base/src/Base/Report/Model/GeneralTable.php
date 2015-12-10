<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_base_report_general`
 */

namespace Base\Report\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class GeneralTable
 * @package Base\Report\Model
 */
class GeneralTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_base_report_general`
     * @var string
     */
    protected $class =  '\Base\Report\Model\General';

    /**
     * @var string
     */
    protected $name =  'base_report_general';

    /**
     * @var array
     */
    protected $column = array(
		'general_id'=>1,
		'poster_id'=>1,
		'poster_type'=>1,
		'created_at'=>1,
		'message'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'general_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'general_id';

    
    /**
     * @param  string|int $value
     * @return \Base\Report\Model\General
     */
    public function findById($value){
       return $this->select()
           ->where('general_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('general_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}