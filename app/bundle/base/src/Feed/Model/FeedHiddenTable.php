<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_feed_hidden`
 */

namespace Feed\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class FeedHiddenTable
 *
 * @package Feed\Model
 */
class FeedHiddenTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_feed_hidden`
     * @var string
     */
    protected $class =  '\Feed\Model\FeedHidden';

    /**
     * @var string
     */
    protected $name =  'feed_hidden';

    /**
     * @var array
     */
    protected $column = array(
		'viewer_id'=>1,
		'feed_id'=>1,
		'created_at'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'viewer_id'=>1, 'feed_id'=>1);

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