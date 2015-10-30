<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_core_uid_generator`
 */

namespace Core\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class UidGeneratorTable
 *
 * @package Core\Model
 */
class UidGeneratorTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_core_uid_generator`
     * @var string
     */
    protected $class = '\Core\Model\UidGenerator';

    /**
     * @var string
     */
    protected $name = 'core_uid_generator';

    /**
     * @var array
     */
    protected $column = [
        'uid' => 1];

    /**
     * @var array
     */
    protected $primary = ['uid' => 1];

    /**
     * @var string
     */
    protected $identity = 'uid';


    /**
     * @param  string|int $value
     *
     * @return \Core\Model\UidGenerator
     */
    public function findById($value)
    {
        return $this->select()
            ->where('uid=?', $value)
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
            ->where('uid IN ?', $value)
            ->all();
    }

    //END_TABLE_GENERATOR
}