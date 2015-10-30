<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_group_category`
 */

namespace Group\Model;

/**
 */
use Picaso\Db\DbTable;

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
     * @see `picaso_group_category`
     * @var string
     */
    protected $class =  '\Group\Model\GroupCategory';

    /**
     * @var string
     */
    protected $name =  'group_category';

    /**
     * @var array
     */
    protected $column = array(
		'category_id'=>1,
		'category_name'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'category_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'category_id';

    
    /**
     * @param  string|int $value
     * @return \Group\Model\GroupCategory
     */
    public function findById($value){
       return $this->select()
           ->where('category_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('category_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}