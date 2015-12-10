<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_base_feed_hash`
 */

namespace Base\Feed\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class HashTable
 * @package Base\Feed\Model
 */
class HashTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_base_feed_hash`
     * @var string
     */
    protected $class =  '\Base\Feed\Model\Hash';

    /**
     * @var string
     */
    protected $name =  'base_feed_hash';

    /**
     * @var array
     */
    protected $column = array(
		'hash_id'=>1,
		'name'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'hash_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'hash_id';

    
    /**
     * @param  string|int $value
     * @return \Base\Feed\Model\Hash
     */
    public function findById($value){
       return $this->select()
           ->where('hash_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('hash_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}