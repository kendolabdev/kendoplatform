<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_user_token`
 */

namespace Platform\User\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\UserTokenTable
 *
 * @package Platform\User\Model
 */
class UserTokenTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_user_token`
     * @var string
     */
    protected $class =  '\Platform\User\Model\UserToken';

    /**
     * @var string
     */
    protected $name =  'platform_user_token';

    /**
     * @var array
     */
    protected $column = array(
		'token_id'=>1,
		'user_id'=>1,
		'viewer_id'=>1,
		'viewer_type'=>1,
		'timestamp'=>1,
		'data_text'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'token_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Platform\User\Model\UserToken
     */
    public function findById($value){
       return $this->select()
           ->where('token_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('token_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}