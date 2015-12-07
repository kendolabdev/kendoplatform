<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_like`
 */

namespace Like\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class LikeTable
 *
 * @package Like\Model
 */
class LikeTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_like`
     * @var string
     */
    protected $class =  '\Like\Model\Like';

    /**
     * @var string
     */
    protected $name =  'like';

    /**
     * @var array
     */
    protected $column = array(
		'about_id'=>1,
		'poster_id'=>1,
		'about_type'=>1,
		'poster_type'=>1,
		'created_at'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'about_id'=>1, 'poster_id'=>1);

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