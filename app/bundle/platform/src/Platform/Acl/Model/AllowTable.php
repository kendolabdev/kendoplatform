<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_acl_allow`
 */

namespace Platform\Acl\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class AllowTable
 * @package Platform\Acl\Model
 */
class AllowTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_acl_allow`
     * @var string
     */
    protected $class =  '\Platform\Acl\Model\Allow';

    /**
     * @var string
     */
    protected $name =  'platform_acl_allow';

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
     * @return \Platform\Acl\Model\Allow
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