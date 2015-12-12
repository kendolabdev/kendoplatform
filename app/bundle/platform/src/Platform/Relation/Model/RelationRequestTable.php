<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_relation_request`
 */

namespace Platform\Relation\Model;

/**
 */
use Kendo\Db\DbTable;
use Kendo\Db\Exception;

/**
 * Class Platform\RelationRequestTable
 *
 * @package Platform\Relation\Model
 */
class RelationRequestTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_relation_request`
     * @var string
     */
    protected $class =  '\Platform\Relation\Model\RelationRequest';

    /**
     * @var string
     */
    protected $name =  'platform_relation_request';

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
     * @throws \Kendo\Db\Exception
     */
    public function findById($value){
       throw new \Kendo\Db\Exception('Can not find by id for '.$value);
    }

    //END_TABLE_GENERATOR
}