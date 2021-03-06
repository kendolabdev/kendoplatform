<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_group`
 */

namespace Platform\Group\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class GroupTable
 *
 * @package Group\Model
 */
class GroupTable extends DbTable
{
	// PUT YOUR CODE HERE

	//START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_group`
     * @var string
     */
    protected $class =  '\Platform\Group\Model\Group';

    /**
     * @var string
     */
    protected $name =  'platform_group';

    /**
     * @var array
     */
    protected $column = array(
		'group_id'=>1,
		'is_published'=>1,
		'is_active'=>1,
		'is_approved'=>1,
		'poster_id'=>1,
		'user_id'=>1,
		'parent_id'=>1,
		'parent_user_id'=>1,
		'photo_file_id'=>1,
		'role_id'=>1,
		'poster_type'=>1,
		'parent_type'=>1,
		'name'=>1,
		'profile_name'=>1,
		'description'=>1,
		'created_at'=>1,
		'modified_at'=>1,
		'comment_count'=>1,
		'like_count'=>1,
		'share_count'=>1,
		'follow_count'=>1,
		'member_count'=>1,
		'privacy_type'=>1,
		'privacy_value'=>1,
		'place_id'=>1,
		'place_type'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'group_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Platform\Group\Model\Group
     */
    public function findById($value){
       return $this->select()
           ->where('group_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('group_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}