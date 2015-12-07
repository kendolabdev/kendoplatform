<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_photo_category`
 */

namespace Photo\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class PhotoCategoryTable
 *
 * @package Photo\Model
 */
class PhotoCategoryTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_photo_category`
     * @var string
     */
    protected $class =  '\Photo\Model\PhotoCategory';

    /**
     * @var string
     */
    protected $name =  'photo_category';

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
     * @return \Photo\Model\PhotoCategory
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