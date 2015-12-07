<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_layout_page`
 */

namespace Layout\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class LayoutPageTable
 *
 * @package Layout\Model
 */
class LayoutPageTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_layout_page`
     * @var string
     */
    protected $class =  '\Layout\Model\LayoutPage';

    /**
     * @var string
     */
    protected $name =  'layout_page';

    /**
     * @var array
     */
    protected $column = array(
		'page_id'=>1,
		'page_name'=>1,
		'parent_page_name'=>1,
		'module_name'=>1,
		'item_module_name'=>1,
		'page_params_text'=>1,
		'page_condition'=>1,
		'is_admin'=>1,
		'base_path'=>1,
		'item_path'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'page_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'page_id';

    
    /**
     * @param  string|int $value
     * @return \Layout\Model\LayoutPage
     */
    public function findById($value){
       return $this->select()
           ->where('page_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('page_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}