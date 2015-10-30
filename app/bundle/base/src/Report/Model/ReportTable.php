<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_report`
 */

namespace Report\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class ReportTable
 *
 * @package Report\Model
 */
class ReportTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_report`
     * @var string
     */
    protected $class =  '\Report\Model\Report';

    /**
     * @var string
     */
    protected $name =  'report';

    /**
     * @var array
     */
    protected $column = array(
		'report_id'=>1,
		'poster_type'=>1,
		'poster_id'=>1,
		'category_id'=>1,
		'about_type'=>1,
		'about_id'=>1,
		'created_at'=>1,
		'message'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'report_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'report_id';

    
    /**
     * @param  string|int $value
     * @return \Report\Model\Report
     */
    public function findById($value){
       return $this->select()
           ->where('report_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('report_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}