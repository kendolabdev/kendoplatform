<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_user_auth_remote`
 */

namespace User\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class UserAuthRemoteTable
 *
 * @package User\Model
 */
class UserAuthRemoteTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_user_auth_remote`
     * @var string
     */
    protected $class =  '\User\Model\UserAuthRemote';

    /**
     * @var string
     */
    protected $name =  'user_auth_remote';

    /**
     * @var array
     */
    protected $column = array(
		'remote_id'=>1,
		'remote_uid'=>1,
		'remote_service'=>1,
		'user_id'=>1,
		'created_at'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'remote_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'remote_id';

    
    /**
     * @param  string|int $value
     * @return \User\Model\UserAuthRemote
     */
    public function findById($value){
       return $this->select()
           ->where('remote_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('remote_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}