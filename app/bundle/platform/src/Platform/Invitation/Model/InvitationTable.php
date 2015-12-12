<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_invitation`
 */

namespace Platform\Invitation\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\InvitationTable
 *
 * @package Platform\Invitation\Model
 */
class InvitationTable extends DbTable
{
	// PUT YOUR CODE HERE

	//START_TABLE_GENERATOR

	/**
	 * @see `picaso_platform_invitation`
	 * @var string
	 */
	protected $class = '\Platform\Invitation\Model\Invitation';

	/**
	 * @var string
	 */
	protected $name = 'platform_invitation';

	/**
	 * @var array
	 */
	protected $column = [
			'id'             => 1,
			'type_id'        => 1,
			'user_id'        => 1,
			'poster_id'      => 1,
			'parent_id'      => 1,
			'parent_user_id' => 1,
			'poster_type'    => 1,
			'parent_type'    => 1,
			'object_id'      => 1,
			'object_type'    => 1,
			'created_at'     => 1,
			'params'         => 1,
			'read'           => 1,
			'mitigated'      => 1];

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
	 * @return \Platform\Invitation\Model\Invitation
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