<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_navigation`
 */

namespace Platform\Navigation\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\NavigationTable
 *
 * @package Platform\Navigation\Model
 */
class NavigationTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_navigation`
     * @var string
     */
    protected $class =  '\Platform\Navigation\Model\Navigation';

    /**
     * @var string
     */
    protected $name =  'platform_navigation';

    /**
     * @var array
     */
    protected $column = array(
		'nav_id'=>1,
		'is_system'=>1,
		'is_admin'=>1,
		'nav_name'=>1,
		'module_name'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'nav_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Platform\Navigation\Model\Navigation
     */
    public function findById($value){
       return $this->select()
           ->where('nav_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('nav_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}