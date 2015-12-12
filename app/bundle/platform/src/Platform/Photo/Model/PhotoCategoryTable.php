<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_photo_category`
 */

namespace Platform\Photo\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\PhotoCategoryTable
 *
 * @package Platform\Photo\Model
 */
class PhotoCategoryTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_photo_category`
     * @var string
     */
    protected $class = '\Platform\Photo\Model\PhotoCategory';

    /**
     * @var string
     */
    protected $name = 'platform_photo_category';

    /**
     * @var array
     */
    protected $column = [
        'category_id'   => 1,
        'category_name' => 1];

    /**
     * @var array
     */
    protected $primary = ['category_id' => 1];

    /**
     * @var string
     */
    protected $identity = 'category_id';


    /**
     * @param  string|int $value
     *
     * @return \Platform\Photo\Model\PhotoCategory
     */
    public function findById($value)
    {
        return $this->select()
            ->where('category_id=?', $value)
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
            ->where('category_id IN ?', $value)
            ->all();
    }

    //END_TABLE_GENERATOR
}