<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_feed_hidden`
 */

namespace Platform\Feed\Model;

/**
 */
use Kendo\Db\DbTable;
use Kendo\Db\Exception;

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
     * @see `picaso_platform_feed_hidden`
     * @var string
     */
    protected $class = '\Platform\Feed\Model\FeedHidden';

    /**
     * @var string
     */
    protected $name = 'platform_feed_hidden';

    /**
     * @var array
     */
    protected $column = [
        'viewer_id'  => 1,
        'feed_id'    => 1,
        'created_at' => 1];

    /**
     * @var array
     */
    protected $primary = ['viewer_id' => 1, 'feed_id' => 1];

    /**
     * @var string
     */
    protected $identity = '';


    /**
     * @param  string|int $value
     *
     * @return null
     * @throws \Kendo\Db\Exception
     */
    public function findById($value)
    {
        throw new \Kendo\Db\Exception('Can not find by id for ' . $value);
    }

    //END_TABLE_GENERATOR
}