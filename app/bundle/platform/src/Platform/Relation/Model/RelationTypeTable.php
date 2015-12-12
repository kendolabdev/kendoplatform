<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_relation_type`
 */

namespace Platform\Relation\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\RelationTypeTable
 *
 * @package Platform\Relation\Model
 */
class RelationTypeTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_relation_type`
     * @var string
     */
    protected $class = '\Platform\Relation\Model\RelationType';

    /**
     * @var string
     */
    protected $name = 'platform_relation_type';

    /**
     * @var array
     */
    protected $column = [
        'parent_type'   => 1,
        'relation_type' => 1,
        'type_id'       => 1,
        'relation_name' => 1,
        'is_build'      => 1,
        'description'   => 1,
        'module_name'   => 1];

    /**
     * @var array
     */
    protected $primary = ['type_id' => 1];

    /**
     * @var string
     */
    protected $identity = 'type_id';


    /**
     * @param  string|int $value
     *
     * @return \Platform\Relation\Model\RelationType
     */
    public function findById($value)
    {
        return $this->select()
            ->where('type_id=?', $value)
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
            ->where('type_id IN ?', $value)
            ->all();
    }

    //END_TABLE_GENERATOR
}