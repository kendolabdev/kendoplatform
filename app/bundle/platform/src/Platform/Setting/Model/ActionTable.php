<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_setting_action`
 */

namespace Platform\Setting\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class ActionTable
 * @package Platform\Setting\Model
 */
class ActionTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_setting_action`
     * @var string
     */
    protected $class =  '\Platform\Setting\Model\Action';

    /**
     * @var string
     */
    protected $name =  'platform_setting_action';

    /**
     * @var array
     */
    protected $column = array(
		'action_id'=>1,
		'module_name'=>1,
		'action_group'=>1,
		'action_name'=>1);

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
     * @return \Platform\Setting\Model\Action
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