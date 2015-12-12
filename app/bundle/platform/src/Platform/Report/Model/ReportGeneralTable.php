<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_report_general`
 */

namespace Platform\Report\Model;

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
     * @see `picaso_platform_report_general`
     * @var string
     */
    protected $class = '\Platform\Report\Model\ReportGeneral';

    /**
     * @var string
     */
    protected $name = 'platform_report_general';

    /**
     * @var array
     */
    protected $column = [
        'general_id'  => 1,
        'poster_id'   => 1,
        'poster_type' => 1,
        'created_at'  => 1,
        'message'     => 1];

    /**
     * @var array
     */
    protected $primary = ['general_id' => 1];

    /**
     * @var string
     */
    protected $identity = 'general_id';


    /**
     * @param  string|int $value
     *
     * @return \Platform\Report\Model\ReportGeneral
     */
    public function findById($value)
    {
        return $this->select()
            ->where('general_id=?', $value)
            ->one();
    }

    /**
     * @param  array $value
     *
     * @return array
     */
    public function findByIdList($value)
    {
        return $this->select()
            ->where('general_id IN ?', $value)
            ->all();
    }

    //END_TABLE_GENERATOR
}