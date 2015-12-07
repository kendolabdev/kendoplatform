<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_acl_group`
 */

namespace Acl\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class AclGroupTable
 *
 * @package Acl\Model
 */
class AclGroupTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_acl_group`
     * @var string
     */
    protected $class =  '\Acl\Model\AclGroup';

    /**
     * @var string
     */
    protected $name =  'acl_group';

    /**
     * @var array
     */
    protected $column = array(
		'group_id'=>1,
		'module_name'=>1,
		'group_title'=>1,
		'group_description'=>1,
		'sort_order'=>1,
		'form_class'=>1);

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
     * @return \Acl\Model\AclGroup
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