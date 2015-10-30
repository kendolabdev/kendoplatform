<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_relation_type`
 */

namespace Relation\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class RelationTypeTable
 *
 * @package Relation\Model
 */
class RelationTypeTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_relation_type`
     * @var string
     */
    protected $class =  '\Relation\Model\RelationType';

    /**
     * @var string
     */
    protected $name =  'relation_type';

    /**
     * @var array
     */
    protected $column = array(
		'parent_type'=>1,
		'relation_type'=>1,
		'type_id'=>1,
		'relation_name'=>1,
		'is_build'=>1,
		'description'=>1,
		'module_name'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'type_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'type_id';

    
    /**
     * @param  string|int $value
     * @return \Relation\Model\RelationType
     */
    public function findById($value){
       return $this->select()
           ->where('type_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('type_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}