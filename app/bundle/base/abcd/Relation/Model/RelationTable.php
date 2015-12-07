<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_relation`
 */

namespace Relation\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class RelationTable
 *
 * @package Relation\Model
 */
class RelationTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_relation`
     * @var string
     */
    protected $class =  '\Relation\Model\Relation';

    /**
     * @var string
     */
    protected $name =  'relation';

    /**
     * @var array
     */
    protected $column = array(
		'relation_id'=>1,
		'relation_type'=>1,
		'relation_name'=>1,
		'parent_id'=>1,
		'parent_type'=>1,
		'item_count'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'relation_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Relation\Model\Relation
     */
    public function findById($value){
       return $this->select()
           ->where('relation_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('relation_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}