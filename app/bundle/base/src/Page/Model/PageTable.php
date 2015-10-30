<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_page`
 */

namespace Page\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class PageTable
 *
 * @package Page\Model
 */
class PageTable extends DbTable
{
	// PUT YOUR CODE HERE

	//START_TABLE_GENERATOR

    /**
     * @see `picaso_page`
     * @var string
     */
    protected $class =  '\Page\Model\Page';

    /**
     * @var string
     */
    protected $name =  'page';

    /**
     * @var array
     */
    protected $column = array(
		'page_id'=>1,
		'is_published'=>1,
		'is_active'=>1,
		'is_approved'=>1,
		'user_id'=>1,
		'poster_id'=>1,
		'parent_id'=>1,
		'parent_user_id'=>1,
		'photo_file_id'=>1,
		'poster_type'=>1,
		'parent_type'=>1,
		'name'=>1,
		'profile_name'=>1,
		'slug'=>1,
		'created_at'=>1,
		'modified_at'=>1,
		'comment_count'=>1,
		'like_count'=>1,
		'member_count'=>1,
		'share_count'=>1,
		'privacy_type'=>1,
		'privacy_value'=>1,
		'place_id'=>1,
		'role_id'=>1,
		'place_type'=>1,
		'follow_count'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'page_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Page\Model\Page
     */
    public function findById($value){
       return $this->select()
           ->where('page_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('page_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}