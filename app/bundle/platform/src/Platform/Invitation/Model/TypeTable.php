<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_invitation_type`
 */

namespace Platform\Invitation\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class TypeTable
 * @package Platform\Invitation\Model
 */
class TypeTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_invitation_type`
     * @var string
     */
    protected $class =  '\Platform\Invitation\Model\Type';

    /**
     * @var string
     */
    protected $name =  'platform_invitation_type';

    /**
     * @var array
     */
    protected $column = array(
		'id'=>1,
		'handler'=>1,
		'title'=>1,
		'is_active'=>1,
		'is_push'=>1,
		'is_mail'=>1,
		'is_sms'=>1,
		'module_name'=>1,
		'show_on_user_config'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Platform\Invitation\Model\Type
     */
    public function findById($value){
       return $this->select()
           ->where('id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}