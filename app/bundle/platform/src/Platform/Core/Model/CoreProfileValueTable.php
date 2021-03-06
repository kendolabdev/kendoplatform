<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_core_profile_value`
 */

namespace Platform\Core\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class CoreProfileValueTable
 *
 * @package Core\Model
 */
class CoreProfileValueTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_core_profile_value`
     * @var string
     */
    protected $class =  '\Platform\Core\Model\CoreProfileValue';

    /**
     * @var string
     */
    protected $name =  'platform_core_profile_value';

    /**
     * @var array
     */
    protected $column = array(
		'id'=>1,
		'profile_id'=>1,
		'name'=>1,
		'sort_order'=>1,
		'value'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'id'=>1);

    /**
     * @var string
     */
    protected $identity = 'id';

    
    /**
     * @param  string|int $value
     * @return \Platform\Core\Model\CoreProfileValue
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