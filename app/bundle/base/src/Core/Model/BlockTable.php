<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_core_block`
 */

namespace Core\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class BlockTable
 *
 * @package Core\Model
 */
class BlockTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_core_block`
     * @var string
     */
    protected $class = '\Core\Model\Block';

    /**
     * @var string
     */
    protected $name = 'core_block';

    /**
     * @var array
     */
    protected $column = [
        'poster_id'   => 1,
        'object_id'   => 1,
        'poster_type' => 1,
        'object_type' => 1,
        'created_at'  => 1];

    /**
     * @var array
     */
    protected $primary = ['poster_id' => 1, 'object_id' => 1];

    /**
     * @var string
     */
    protected $identity = '';


    /**
     * @param  string|int $value
     *
     * @return null
     * @throws \Picaso\Db\Exception
     */
    public function findById($value)
    {
        throw new \Picaso\Db\Exception('Can not find by id for ' . $value);
    }

    //END_TABLE_GENERATOR
}