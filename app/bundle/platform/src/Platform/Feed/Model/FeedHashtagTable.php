<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_feed_hashtag`
 */

namespace Platform\Feed\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class FeedHashtagTable
 *
 * @package Feed\Model
 */
class FeedHashtagTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_feed_hashtag`
     * @var string
     */
    protected $class = '\Platform\Feed\Model\FeedHashtag';

    /**
     * @var string
     */
    protected $name = 'platform_feed_hashtag';

    /**
     * @var array
     */
    protected $column = [
        'feed_id' => 1,
        'hash_id' => 1];

    /**
     * @var array
     */
    protected $primary = ['feed_id' => 1];

    /**
     * @var string
     */
    protected $identity = '';


    /**
     * @param  string|int $value
     *
     * @return \Platform\Feed\Model\FeedHashtag
     */
    public function findById($value)
    {
        return $this->select()
            ->where('feed_id=?', $value)
            ->one();
    }

    /**
     * @param  array $value
     *
     * @return array
     */
    public function findByIdList($value)
    {
        return $this->select()
            ->where('feed_id IN ?', $value)
            ->all();
    }

    //END_TABLE_GENERATOR
}