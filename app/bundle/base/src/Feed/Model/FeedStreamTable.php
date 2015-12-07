<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_feed_stream`
 */

namespace Feed\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class FeedStreamTable
 *
 * @package Feed\Model
 */
class FeedStreamTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_feed_stream`
     * @var string
     */
    protected $class =  '\Feed\Model\FeedStream';

    /**
     * @var string
     */
    protected $name =  'feed_stream';

    /**
     * @var array
     */
    protected $column = array(
		'profile_id'=>1,
		'feed_id'=>1,
		'profile_type'=>1,
		'feed_type'=>1,
		'poster_id'=>1,
		'about_id'=>1,
		'parent_id'=>1,
		'privacy_type'=>1,
		'privacy_value'=>1,
		'params_text'=>1,
		'is_hidden'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'profile_id'=>1, 'feed_id'=>1);

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