<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_acl_allow`
 */

namespace Acl\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class AclAllowTable
 *
 * @package Acl\Model
 */
class AclAllowTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_acl_allow`
     * @var string
     */
    protected $class =  '\Acl\Model\AclAllow';

    /**
     * @var string
     */
    protected $name =  'acl_allow';

    /**
     * @var array
     */
    protected $column = array(
		'allow_id'=>1,
		'role_id'=>1,
		'action_id'=>1,
		'value'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'allow_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'allow_id';

    
    /**
     * @param  string|int $value
     * @return \Acl\Model\AclAllow
     */
    public function findById($value){
       return $this->select()
           ->where('allow_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('allow_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}