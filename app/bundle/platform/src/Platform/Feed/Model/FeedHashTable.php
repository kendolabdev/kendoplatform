<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_feed_hash`
 */

namespace Platform\Feed\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class FeedHashTable
 *
 * @package Feed\Model
 */
class FeedHashTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_feed_hash`
     * @var string
     */
    protected $class =  '\Platform\Feed\Model\FeedHash';

    /**
     * @var string
     */
    protected $name =  'platform_feed_hash';

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
     * @return \Platform\Feed\Model\FeedHash
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