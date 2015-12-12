<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_blog_post`
 */

namespace Base\Blog\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Base\BlogPostTable
 *
 * @package Base\Blog\Model
 */
class BlogPostTable extends DbTable
{
	// PUT YOUR CODE HERE

	//START_TABLE_GENERATOR

    /**
     * @see `picaso_base_blog_post`
     * @var string
     */
    protected $class =  '\Base\Blog\Model\BlogPost';

    /**
     * @var string
     */
    protected $name =  'base_blog_post';

    /**
     * @var array
     */
    protected $column = array(
		'post_id'=>1,
		'poster_id'=>1,
		'user_id'=>1,
		'parent_id'=>1,
		'parent_user_id'=>1,
		'poster_type'=>1,
		'parent_type'=>1,
		'is_active'=>1,
		'is_published'=>1,
		'is_approved'=>1,
		'title'=>1,
		'description'=>1,
		'slug'=>1,
		'content'=>1,
		'created_at'=>1,
		'modified_at'=>1,
		'follow_count'=>1,
		'comment_count'=>1,
		'share_count'=>1,
		'view_count'=>1,
		'like_count'=>1,
		'privacy_type'=>1,
		'privacy_value'=>1,
		'privacy_text'=>1,
		'people_count'=>1,
		'place_id'=>1,
		'place_type'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'post_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Base\Blog\Model\BlogPost
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