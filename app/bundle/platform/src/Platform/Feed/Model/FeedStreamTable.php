<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_feed_stream`
 */

namespace Platform\Feed\Model;

/**
 */
use Kendo\Db\DbTable;
use Kendo\Db\Exception;

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
	 * @see `picaso_platform_feed_stream`
	 * @var string
	 */
	protected $class = '\Platform\Feed\Model\FeedStream';

	/**
	 * @var string
	 */
	protected $name = 'platform_feed_stream';

	/**
	 * @var array
	 */
	protected $column = [
			'profile_id'    => 1,
			'feed_id'       => 1,
			'profile_type'  => 1,
			'feed_type'     => 1,
			'poster_id'     => 1,
			'about_id'      => 1,
			'parent_id'     => 1,
			'privacy_type'  => 1,
			'privacy_value' => 1,
			'params_text'   => 1,
			'is_hidden'     => 1];

	/**
	 * @var array
	 */
	protected $primary = ['profile_id' => 1, 'feed_id' => 1];

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