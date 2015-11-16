<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_acl_role`
 */

namespace Acl\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class AclRoleTable
 *
 * @package Acl\Model
 */
class AclRoleTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_acl_role`
     * @var string
     */
    protected $class =  '\Acl\Model\AclRole';

    /**
     * @var string
     */
    protected $name =  'acl_role';

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
     * @return \Acl\Model\AclRole
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