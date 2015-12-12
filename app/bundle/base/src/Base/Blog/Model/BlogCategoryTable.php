<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_blog_category`
 */

namespace Base\Blog\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Base\BlogCategoryTable
 *
 * @package Base\Blog\Model
 */
class BlogCategoryTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_base_blog_category`
     * @var string
     */
    protected $class =  '\Base\Blog\Model\BlogCategory';

    /**
     * @var string
     */
    protected $name =  'base_blog_category';

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
     * @return \Base\Blog\Model\BlogCategory
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