<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_user`
 */

namespace Platform\User\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\UserTable
 *
 * @package Platform\User\Model
 */
class UserTable extends DbTable
{

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_user`
     * @var string
     */
    protected $class =  '\Platform\User\Model\User';

    /**
     * @var string
     */
    protected $name =  'platform_user';

    /**
     * @var array
     */
    protected $column = array(
		'user_id'=>1,
		'is_published'=>1,
		'is_active'=>1,
		'is_verified'=>1,
		'is_approved'=>1,
		'catalog_id'=>1,
		'photo_file_id'=>1,
		'name'=>1,
		'profile_name'=>1,
		'email'=>1,
		'gender'=>1,
		'modified_at'=>1,
		'created_at'=>1,
		'comment_count'=>1,
		'share_count'=>1,
		'member_count'=>1,
		'like_count'=>1,
		'follow_count'=>1,
		'privacy_type'=>1,
		'privacy_value'=>1,
		'privacy_text'=>1,
		'role_id'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'user_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Platform\User\Model\User
     */
    public function findById($value){
       return $this->select()
           ->where('user_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('user_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}