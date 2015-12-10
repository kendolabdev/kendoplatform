<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_base_feed_hidden`
 */

namespace Base\Feed\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class HiddenTable
 * @package Base\Feed\Model
 */
class HiddenTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_base_feed_hidden`
     * @var string
     */
    protected $class =  '\Base\Feed\Model\Hidden';

    /**
     * @var string
     */
    protected $name =  'base_feed_hidden';

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
     * @throws \Kendo\Db\Exception
     */
    public function findById($value){
       throw new \Kendo\Db\Exception('Can not find by id for '.$value);
    }

    //END_TABLE_GENERATOR
}