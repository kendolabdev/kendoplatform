<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_photo_cover`
 */

namespace Platform\Photo\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\PhotoCoverTable
 *
 * @package Platform\Photo\Model
 */
class PhotoCoverTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_photo_cover`
     * @var string
     */
    protected $class = '\Platform\Photo\Model\PhotoCover';

    /**
     * @var string
     */
    protected $name = 'platform_photo_cover';

    /**
     * @var array
     */
    protected $column = [
        'object_id'     => 1,
        'object_type'   => 1,
        'photo_id'      => 1,
        'photo_file_id' => 1,
        'position_top'  => 1,
        'created_at'    => 1];

    /**
     * @var array
     */
    protected $primary = ['object_id' => 1];

    /**
     * @var string
     */
    protected $identity = '';


    /**
     * @param  string|int $value
     *
     * @return \Platform\Photo\Model\PhotoCover
     */
    public function findById($value)
    {
        return $this->select()
            ->where('object_id=?', $value)
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
            ->where('object_id IN ?', $value)
            ->all();
    }

    //END_TABLE_GENERATOR
}