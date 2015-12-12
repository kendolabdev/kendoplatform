<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_notification`
 */

namespace Platform\Notification\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\NotificationTable
 *
 * @package Platform\Notification\Model
 */
class NotificationTable extends DbTable
{
	// PUT YOUR CODE HERE

	//START_TABLE_GENERATOR

	/**
	 * @see `picaso_platform_notification`
	 * @var string
	 */
	protected $class = '\Platform\Notification\Model\Notification';

	/**
	 * @var string
	 */
	protected $name = 'platform_notification';

	/**
	 * @var array
	 */
	protected $column = [
			'id'             => 1,
			'type_id'        => 1,
			'poster_id'      => 1,
			'user_id'        => 1,
			'parent_id'      => 1,
			'parent_user_id' => 1,
			'poster_type'    => 1,
			'parent_type'    => 1,
			'about_id'       => 1,
			'about_type'     => 1,
			'created_at'     => 1,
			'read'           => 1,
			'mitigated'      => 1,
			'params'         => 1,
			'atom_type'      => 1,
			'atom_id'        => 1];

	/**
	 * @var array
	 */
	protected $primary = ['id' => 1];

	/**
	 * @var string
	 */
	protected $identity = 'id';


	/**
	 * @param  string|int $value
	 *
	 * @return \Platform\Notification\Model\Notification
	 */
	public function findById($value)
	{
		return $this->select()
				->where('id=?', $value)
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
				->where('id IN ?', $value)
				->all();
	}

	//END_TABLE_GENERATOR
}