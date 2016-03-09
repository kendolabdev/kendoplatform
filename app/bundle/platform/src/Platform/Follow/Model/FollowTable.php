<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_follow`
 */

namespace Platform\Follow\Model;

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
     * @see `picaso_platform_follow`
     * @var string
     */
    protected $class =  '\Platform\Follow\Model\Follow';

    /**
     * @var string
     */
    protected $name =  'platform_follow';

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