<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_core_extension`
 */

namespace Platform\Core\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class CoreExtensionTable
 *
 * @package Core\Model
 */
class CoreExtensionTable extends DbTable
{
	// PUT YOUR CODE HERE

	//START_TABLE_GENERATOR

	/**
	 * @see `picaso_platform_core_extension`
	 * @var string
	 */
	protected $class = '\Platform\Core\Model\CoreExtension';

	/**
	 * @var string
	 */
	protected $name = 'platform_core_extension';

	/**
	 * @var array
	 */
	protected $column = [
			'id'              => 1,
			'extension_type'  => 1,
			'name'            => 1,
			'load_order'      => 1,
			'loader_name'     => 1,
			'path'            => 1,
			'is_active'       => 1,
			'is_system'       => 1,
			'namespace'       => 1,
			'title'           => 1,
			'author'          => 1,
			'description'     => 1,
			'version'         => 1,
			'latest_version'  => 1,
			'created_at'      => 1,
			'modified_at'     => 1,
			'vendor_id'       => 1,
			'install_path'    => 1,
			'install_handler' => 1,
			'is_installed'    => 1];

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
	 * @return \Platform\Core\Model\CoreExtension
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