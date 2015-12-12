<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_layout_block_decorator`
 */

namespace Platform\Layout\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\LayoutBlockDecoratorTable
 *
 * @package Platform\Layout\Model
 */
class LayoutBlockDecoratorTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_layout_block_decorator`
     * @var string
     */
    protected $class = '\Platform\Layout\Model\LayoutBlockDecorator';

    /**
     * @var string
     */
    protected $name = 'platform_layout_block_decorator';

    /**
     * @var array
     */
    protected $column = [
        'id'              => 1,
        'name'            => 1,
        'form_class'      => 1,
        'decorator_class' => 1];

    /**
     * @var array
     */
    protected $primary = ['id' => 1];

    /**
     * @var string
     */
    protected $identity = '';


    /**
     * @param  string|int $value
     *
     * @return \Platform\Layout\Model\LayoutBlockDecorator
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