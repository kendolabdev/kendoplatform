<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_acl_role`
 */

namespace Platform\Acl\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class RoleTable
 * @package Platform\Acl\Model
 */
class RoleTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_acl_role`
     * @var string
     */
    protected $class =  '\Platform\Acl\Model\Role';

    /**
     * @var string
     */
    protected $name =  'platform_acl_role';

    /**
     * @var array
     */
    protected $column = array(
		'role_id'=>1,
		'parent_role_id'=>1,
		'role_type'=>1,
		'is_system'=>1,
		'module_name'=>1,
		'title'=>1,
		'is_super'=>1,
		'is_admin'=>1,
		'is_moderator'=>1,
		'is_member'=>1,
		'is_guest'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'role_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'role_id';

    
    /**
     * @param  string|int $value
     * @return \Platform\Acl\Model\Role
     */
    public function findById($value){
       return $this->select()
           ->where('role_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('role_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}