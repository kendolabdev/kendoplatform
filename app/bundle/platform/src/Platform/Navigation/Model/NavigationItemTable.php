<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_navigation_item`
 */

namespace Platform\Navigation\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\NavigationItemTable
 *
 * @package Platform\Navigation\Model
 */
class NavigationItemTable extends DbTable
{
	// PUT YOUR CODE HERE

	//START_TABLE_GENERATOR

	/**
	 * @see `picaso_platform_navigation_item`
	 * @var string
	 */
	protected $class = '\Platform\Navigation\Model\NavigationItem';

	/**
	 * @var string
	 */
	protected $name = 'platform_navigation_item';

	/**
	 * @var array
	 */
	protected $column = [
			'item_id'     => 1,
			'nav_id'      => 1,
			'is_active'   => 1,
			'sort_order'  => 1,
			'module_name' => 1,
			'item_name'   => 1,
			'phrase_name' => 1,
			'parent_name' => 1,
			'item_type'   => 1,
			'event'       => 1,
			'acl'         => 1,
			'route'       => 1,
			'params_text' => 1,
			'query_text'  => 1,
			'extra_text'  => 1,
			'icon'        => 1,
			'mobile_icon' => 1];

	/**
	 * @var array
	 */
	protected $primary = ['item_id' => 1];

	/**
	 * @var string
	 */
	protected $identity = 'item_id';


	/**
	 * @param  string|int $value
	 *
	 * @return \Platform\Navigation\Model\NavigationItem
	 */
	public function findById($value)
	{
		return $this->select()
				->where('item_id=?', $value)
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
				->where('item_id IN ?', $value)
				->all();
	}

	//END_TABLE_GENERATOR
}