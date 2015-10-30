<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_relation_request`
 */

namespace Relation\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class RelationRequestTable
 *
 * @package Relation\Model
 */
class RelationRequestTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_relation_request`
     * @var string
     */
    protected $class =  '\Relation\Model\RelationRequest';

    /**
     * @var string
     */
    protected $name =  'relation_request';

    /**
     * @var array
     */
    protected $column = array(
		'parent_id'=>1,
		'poster_id'=>1,
		'poster_type'=>1,
		'parent_type'=>1,
		'relation_type'=>1,
		'status'=>1,
		'created_at'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'parent_id'=>1, 'poster_id'=>1);

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