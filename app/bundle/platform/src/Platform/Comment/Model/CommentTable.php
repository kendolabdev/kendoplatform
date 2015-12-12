<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_comment`
 */

namespace Platform\Comment\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Base\CommentTable
 *
 * @package Base\Comment\Model
 */
class CommentTable extends DbTable
{
	// PUT YOUR CODE HERE

	//START_TABLE_GENERATOR

	/**
	 * @see `picaso_platform_comment`
	 * @var string
	 */
	protected $class = '\Platform\Comment\Model\Comment';

	/**
	 * @var string
	 */
	protected $name = 'platform_comment';

	/**
	 * @var array
	 */
	protected $column = [
			'comment_id'      => 1,
			'poster_id'       => 1,
			'user_id'         => 1,
			'parent_id'       => 1,
			'parent_user_id'  => 1,
			'about_id'        => 1,
			'about_type'      => 1,
			'poster_type'     => 1,
			'parent_type'     => 1,
			'like_count'      => 1,
			'content'         => 1,
			'created_at'      => 1,
			'attachment_type' => 1,
			'attachment_id'   => 1];

	/**
	 * @var array
	 */
	protected $primary = ['comment_id' => 1];

	/**
	 * @var string
	 */
	protected $identity = '';


	/**
	 * @param  string|int $value
	 *
	 * @return \Platform\Comment\Model\Comment
	 */
	public function findById($value)
	{
		return $this->select()
				->where('comment_id=?', $value)
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
				->where('comment_id IN ?', $value)
				->all();
	}

	//END_TABLE_GENERATOR
}