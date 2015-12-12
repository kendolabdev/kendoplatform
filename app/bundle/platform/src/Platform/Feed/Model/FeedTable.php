<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_feed_feed`
 */

namespace Platform\Feed\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class FeedTable
 *
 * @package Feed\Model
 */
class FeedTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_feed`
     * @var string
     */
    protected $class =  '\Platform\Feed\Model\Feed';

    /**
     * @var string
     */
    protected $name =  'platform_feed';

    /**
     * @var array
     */
    protected $column = array(
		'feed_id'=>1,
		'feed_type'=>1,
		'poster_id'=>1,
		'poster_type'=>1,
		'parent_id'=>1,
		'parent_type'=>1,
		'about_id'=>1,
		'about_type'=>1,
		'privacy_type'=>1,
		'privacy_value'=>1,
		'params_text'=>1,
		'created_at'=>1);

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
     * @return \Platform\Feed\Model\Feed
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