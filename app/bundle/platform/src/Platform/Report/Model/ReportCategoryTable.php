<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_report_category`
 */

namespace Platform\Report\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class ReportCategoryTable
 *
 * @package Report\Model
 */
class ReportCategoryTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_report_category`
     * @var string
     */
    protected $class = '\Platform\Report\Model\ReportCategory';

    /**
     * @var string
     */
    protected $name = 'platform_report_category';

    /**
     * @var array
     */
    protected $column = [
        'category_id'   => 1,
        'category_name' => 1];

    /**
     * @var array
     */
    protected $primary = ['category_id' => 1];

    /**
     * @var string
     */
    protected $identity = 'category_id';


    /**
     * @param  string|int $value
     *
     * @return \Platform\Report\Model\ReportCategory
     */
    public function findById($value)
    {
        return $this->select()
            ->where('category_id=?', $value)
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
            ->where('category_id IN ?', $value)
            ->all();
    }

    //END_TABLE_GENERATOR
}