<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_user_auth_password`
 */

namespace Platform\User\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\UserAuthPasswordTable
 *
 * @package Platform\User\Model
 */
class UserAuthPasswordTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_user_auth_password`
     * @var string
     */
    protected $class =  '\Platform\User\Model\UserAuthPassword';

    /**
     * @var string
     */
    protected $name =  'platform_user_auth_password';

    /**
     * @var array
     */
    protected $column = array(
		'password_id'=>1,
		'user_id'=>1,
		'is_active'=>1,
		'enctype'=>1,
		'hash'=>1,
		'salt'=>1,
		'created_at'=>1,
		'modified_at'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'password_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'password_id';

    
    /**
     * @param  string|int $value
     * @return \Platform\User\Model\UserAuthPassword
     */
    public function findById($value){
       return $this->select()
           ->where('password_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('password_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}