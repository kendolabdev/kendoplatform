<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_help_category`
 */

namespace Help\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class HelpCategoryTable
 *
 * @package Help\Model
 */
class HelpCategoryTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_help_category`
     * @var string
     */
    protected $class =  '\Help\Model\HelpCategory';

    /**
     * @var string
     */
    protected $name =  'help_category';

    /**
     * @var array
     */
    protected $column = array(
		'category_id'=>1,
		'category_active'=>1,
		'category_sort_order'=>1,
		'category_name'=>1,
		'category_slug'=>1);

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
     * @return \Help\Model\HelpCategory
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