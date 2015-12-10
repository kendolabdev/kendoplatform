<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_base_help_post`
 */

namespace Base\Help\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class PostTable
 * @package Base\Help\Model
 */
class PostTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_base_help_post`
     * @var string
     */
    protected $class =  '\Base\Help\Model\Post';

    /**
     * @var string
     */
    protected $name =  'base_help_post';

    /**
     * @var array
     */
    protected $column = array(
		'post_id'=>1,
		'topic_id'=>1,
		'post_active'=>1,
		'post_sort_order'=>1,
		'post_title'=>1,
		'post_slug'=>1,
		'post_content'=>1,
		'post_description'=>1,
		'created_at'=>1,
		'updated_at'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'post_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'post_id';

    
    /**
     * @param  string|int $value
     * @return \Base\Help\Model\Post
     */
    public function findById($value){
       return $this->select()
           ->where('post_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('post_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}