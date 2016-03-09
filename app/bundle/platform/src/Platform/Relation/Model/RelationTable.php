<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_relation`
 */

namespace Platform\Relation\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\RelationTable
 *
 * @package Platform\Relation\Model
 */
class RelationTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_relation`
     * @var string
     */
    protected $class =  '\Platform\Relation\Model\Relation';

    /**
     * @var string
     */
    protected $name =  'platform_relation';

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
     * @return \Platform\Relation\Model\Relation
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