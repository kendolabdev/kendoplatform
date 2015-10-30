<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_comment`
 */

namespace Comment\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class CommentTable
 *
 * @package Comment\Model
 */
class CommentTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_comment`
     * @var string
     */
    protected $class =  '\Comment\Model\Comment';

    /**
     * @var string
     */
    protected $name =  'comment';

    /**
     * @var array
     */
    protected $column = array(
		'comment_id'=>1,
		'poster_id'=>1,
		'user_id'=>1,
		'parent_id'=>1,
		'parent_user_id'=>1,
		'about_id'=>1,
		'about_type'=>1,
		'poster_type'=>1,
		'parent_type'=>1,
		'like_count'=>1,
		'content'=>1,
		'created_at'=>1,
		'attachment_type'=>1,
		'attachment_id'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'comment_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Comment\Model\Comment
     */
    public function findById($value){
       return $this->select()
           ->where('comment_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('comment_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}