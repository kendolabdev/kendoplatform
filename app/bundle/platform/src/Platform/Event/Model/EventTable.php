<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_event`
 */

namespace Platform\Event\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class EventTable
 *
 * @package Event\Model
 */
class EventTable extends DbTable
{
	// PUT YOUR CODE HERE

	//START_TABLE_GENERATOR

	/**
	 * @see `picaso_platform_event`
	 * @var string
	 */
	protected $class = '\Platform\Event\Model\Event';

	/**
	 * @var string
	 */
	protected $name = 'platform_event';

	/**
	 * @var array
	 */
	protected $column = [
			'event_id'       => 1,
			'is_published'   => 1,
			'is_active'      => 1,
			'is_approved'    => 1,
			'poster_id'      => 1,
			'user_id'        => 1,
			'parent_id'      => 1,
			'parent_user_id' => 1,
			'photo_file_id'  => 1,
			'role_id'        => 1,
			'poster_type'    => 1,
			'parent_type'    => 1,
			'name'           => 1,
			'profile_name'   => 1,
			'description'    => 1,
			'created_at'     => 1,
			'modified_at'    => 1,
			'comment_count'  => 1,
			'like_count'     => 1,
			'follow_count'   => 1,
			'share_count'    => 1,
			'member_count'   => 1,
			'privacy_type'   => 1,
			'privacy_value'  => 1,
			'privacy_text'   => 1,
			'place_id'       => 1,
			'place_type'     => 1];

	/**
	 * @var array
	 */
	protected $primary = ['event_id' => 1];

	/**
	 * @var string
	 */
	protected $identity = '';


	/**
	 * @param  string|int $value
	 *
	 * @return \Platform\Event\Model\Event
	 */
	public function findById($value)
	{
		return $this->select()
				->where('event_id=?', $value)
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
				->where('event_id IN ?', $value)
				->all();
	}

	//END_TABLE_GENERATOR
}