<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_relation_item`
 */

namespace Platform\Relation\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class ItemTable
 * @package Platform\Relation\Model
 */
class ItemTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_relation_item`
     * @var string
     */
    protected $class =  '\Platform\Relation\Model\Item';

    /**
     * @var string
     */
    protected $name =  'platform_relation_item';

    /**
     * @var array
     */
    protected $column = array(
		'relation_id'=>1,
		'poster_id'=>1,
		'parent_id'=>1,
		'poster_type'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'relation_id'=>1, 'poster_id'=>1);

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