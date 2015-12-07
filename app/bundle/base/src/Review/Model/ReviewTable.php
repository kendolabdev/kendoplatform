<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_review`
 */

namespace Review\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class ReviewTable
 *
 * @package Review\Model
 */
class ReviewTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_review`
     * @var string
     */
    protected $class =  '\Review\Model\Review';

    /**
     * @var string
     */
    protected $name =  'review';

    /**
     * @var array
     */
    protected $column = array(
		'review_id'=>1,
		'about_id'=>1,
		'is_active'=>1,
		'is_approved'=>1,
		'is_published'=>1,
		'poster_id'=>1,
		'user_id'=>1,
		'parent_id'=>1,
		'parent_user_id'=>1,
		'about_type'=>1,
		'poster_type'=>1,
		'parent_type'=>1,
		'title'=>1,
		'content'=>1,
		'score'=>1,
		'created_at'=>1,
		'modified_at'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'review_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Review\Model\Review
     */
    public function findById($value){
       return $this->select()
           ->where('review_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('review_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}