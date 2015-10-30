<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_page_category`
 */

namespace Page\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class PageCategoryTable
 *
 * @package Page\Model
 */
class PageCategoryTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_page_category`
     * @var string
     */
    protected $class =  '\Page\Model\PageCategory';

    /**
     * @var string
     */
    protected $name =  'page_category';

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
     * @return \Page\Model\PageCategory
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