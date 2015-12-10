<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_base_feed_hashtag`
 */

namespace Base\Feed\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class HashtagTable
 * @package Base\Feed\Model
 */
class HashtagTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_base_feed_hashtag`
     * @var string
     */
    protected $class =  '\Base\Feed\Model\Hashtag';

    /**
     * @var string
     */
    protected $name =  'base_feed_hashtag';

    /**
     * @var array
     */
    protected $column = array(
		'feed_id'=>1,
		'hash_id'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'feed_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Base\Feed\Model\Hashtag
     */
    public function findById($value){
       return $this->select()
           ->where('feed_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('feed_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}