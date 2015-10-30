<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_navigation_item`
 */

namespace Navigation\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class NavigationItemTable
 *
 * @package Navigation\Model
 */
class NavigationItemTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_navigation_item`
     * @var string
     */
    protected $class =  '\Navigation\Model\NavigationItem';

    /**
     * @var string
     */
    protected $name =  'navigation_item';

    /**
     * @var array
     */
    protected $column = array(
		'item_id'=>1,
		'nav_id'=>1,
		'is_active'=>1,
		'sort_order'=>1,
		'module_name'=>1,
		'item_name'=>1,
		'parent_name'=>1,
		'item_type'=>1,
		'event'=>1,
		'acl'=>1,
		'route'=>1,
		'params_text'=>1,
		'query_text'=>1,
		'extra_text'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'item_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'item_id';

    
    /**
     * @param  string|int $value
     * @return \Navigation\Model\NavigationItem
     */
    public function findById($value){
       return $this->select()
           ->where('item_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('item_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}