<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_follow`
 */

namespace Base\Follow\Model;

/**
 */
use Kendo\Db\DbTable;
use Kendo\Db\Exception;

/**
 * Class FollowTable
 *
 * @package Follow\Model
 */
class FollowTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_base_follow`
     * @var string
     */
    protected $class =  '\Base\Follow\Model\Follow';

    /**
     * @var string
     */
    protected $name =  'base_follow';

    /**
     * @var array
     */
    protected $column = array(
		'poster_id'=>1,
		'parent_id'=>1,
		'poster_type'=>1,
		'parent_type'=>1,
		'created_at'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'poster_id'=>1, 'parent_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return null
     * @throws \Kendo\Db\Exception
     */
    public function findById($value){
       throw new \Kendo\Db\Exception('Can not find by id for '.$value);
    }

    //END_TABLE_GENERATOR
}