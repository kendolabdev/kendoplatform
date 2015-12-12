<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_group_category`
 */

namespace Platform\Group\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class GroupCategoryTable
 *
 * @package Group\Model
 */
class GroupCategoryTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_group_category`
     * @var string
     */
    protected $class = '\Platform\Group\Model\GroupCategory';

    /**
     * @var string
     */
    protected $name = 'platform_group_category';

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
     * @return \Platform\Group\Model\GroupCategory
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