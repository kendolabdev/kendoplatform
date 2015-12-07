<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_report_general`
 */

namespace Report\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class ReportGeneralTable
 *
 * @package Report\Model
 */
class ReportGeneralTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_report_general`
     * @var string
     */
    protected $class =  '\Report\Model\ReportGeneral';

    /**
     * @var string
     */
    protected $name =  'report_general';

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
     * @return \Report\Model\ReportGeneral
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