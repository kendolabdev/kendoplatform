<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_base_page_category`
 */

namespace Base\Page\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class CategoryTable
 * @package Base\Page\Model
 */
class CategoryTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_base_page_category`
     * @var string
     */
    protected $class =  '\Base\Page\Model\Category';

    /**
     * @var string
     */
    protected $name =  'base_page_category';

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
     * @return \Base\Page\Model\Category
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