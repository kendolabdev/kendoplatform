<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_report`
 */

namespace Platform\Report\Model;

/**
 */
use Kendo\Db\DbTable;

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
     * @see `picaso_platform_report`
     * @var string
     */
    protected $class =  '\Platform\Report\Model\Report';

    /**
     * @var string
     */
    protected $name =  'platform_report';

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
     * @return \Platform\Report\Model\Report
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