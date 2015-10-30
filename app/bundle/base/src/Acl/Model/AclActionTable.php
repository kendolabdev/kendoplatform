<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_acl_action`
 */

namespace Acl\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class AclActionTable
 *
 * @package Acl\Model
 */
class AclActionTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_acl_action`
     * @var string
     */
    protected $class =  '\Acl\Model\AclAction';

    /**
     * @var string
     */
    protected $name =  'acl_action';

    /**
     * @var array
     */
    protected $column = array(
		'action_id'=>1,
		'module_name'=>1,
		'group_name'=>1,
		'action_name'=>1,
		'comment'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'action_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'action_id';

    
    /**
     * @param  string|int $value
     * @return \Acl\Model\AclAction
     */
    public function findById($value){
       return $this->select()
           ->where('action_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('action_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}