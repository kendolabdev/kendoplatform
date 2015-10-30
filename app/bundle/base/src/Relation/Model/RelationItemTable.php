<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_relation_item`
 */

namespace Relation\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class RelationItemTable
 *
 * @package Relation\Model
 */
class RelationItemTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_relation_item`
     * @var string
     */
    protected $class =  '\Relation\Model\RelationItem';

    /**
     * @var string
     */
    protected $name =  'relation_item';

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
     * @throws \Picaso\Db\Exception
     */
    public function findById($value){
       throw new \Picaso\Db\Exception('Can not find by id for '.$value);
    }

    //END_TABLE_GENERATOR
}