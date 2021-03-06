<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_layout_theme`
 */

namespace Platform\Layout\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\LayoutThemeTable
 *
 * @package Platform\Layout\Model
 */
class LayoutThemeTable extends DbTable
{
	// PUT YOUR CODE HERE

	//START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_layout_theme`
     * @var string
     */
    protected $class =  '\Platform\Layout\Model\LayoutTheme';

    /**
     * @var string
     */
    protected $name =  'platform_layout_theme';

    /**
     * @var array
     */
    protected $column = array(
		'theme_id'=>1,
		'name'=>1,
		'extension_name'=>1,
		'parent_theme_id'=>1,
		'super_theme_id'=>1,
		'is_active'=>1,
		'is_editing'=>1,
		'is_default'=>1,
		'variable_params'=>1,
		'description'=>1,
		'screen_shorts'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'theme_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Platform\Layout\Model\LayoutTheme
     */
    public function findById($value){
       return $this->select()
           ->where('theme_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('theme_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}