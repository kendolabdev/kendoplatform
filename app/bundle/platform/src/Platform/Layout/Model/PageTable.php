<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_layout_page`
 */

namespace Platform\Layout\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class PageTable
 * @package Platform\Layout\Model
 */
class PageTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_layout_page`
     * @var string
     */
    protected $class =  '\Platform\Layout\Model\Page';

    /**
     * @var string
     */
    protected $name =  'platform_layout_page';

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
     * @return \Platform\Layout\Model\Page
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