<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_layout`
 */

namespace Platform\Layout\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\LayoutTable
 *
 * @package Platform\Layout\Model
 */
class LayoutTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_layout`
     * @var string
     */
    protected $class =  '\Platform\Layout\Model\Layout';

    /**
     * @var string
     */
    protected $name =  'platform_layout';

    /**
     * @var array
     */
    protected $column = array(
		'layout_id'=>1,
		'screen_size'=>1,
		'is_active'=>1,
		'page_id'=>1,
		'theme_id'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'layout_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'layout_id';

    
    /**
     * @param  string|int $value
     * @return \Platform\Layout\Model\Layout
     */
    public function findById($value){
       return $this->select()
           ->where('layout_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('layout_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}