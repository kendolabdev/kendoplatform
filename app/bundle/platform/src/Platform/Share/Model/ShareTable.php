<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_share`
 */

namespace Platform\Share\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class ShareTable
 *
 * @package Share\Model
 */
class ShareTable extends DbTable
{
	// PUT YOUR CODE HERE

	//START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_share`
     * @var string
     */
    protected $class =  '\Platform\Share\Model\Share';

    /**
     * @var string
     */
    protected $name =  'platform_share';

    /**
     * @var array
     */
    protected $column = array(
		'share_id'=>1,
		'poster_id'=>1,
		'user_id'=>1,
		'parent_id'=>1,
		'parent_user_id'=>1,
		'feed_id'=>1,
		'parent_share_id'=>1,
		'poster_type'=>1,
		'parent_type'=>1,
		'about_id'=>1,
		'about_type'=>1,
		'privacy_type'=>1,
		'privacy_value'=>1,
		'like_count'=>1,
		'comment_count'=>1,
		'share_count'=>1,
		'params_text'=>1,
		'privacy_text'=>1,
		'people_count'=>1,
		'story'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'share_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Platform\Share\Model\Share
     */
    public function findById($value){
       return $this->select()
           ->where('share_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('share_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}