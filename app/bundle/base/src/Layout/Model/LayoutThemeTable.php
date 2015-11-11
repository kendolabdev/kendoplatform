<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_layout_theme`
 */

namespace Layout\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class LayoutThemeTable
 * @package Layout\Model
 */
class LayoutThemeTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_layout_theme`
     * @var string
     */
    protected $class =  '\Layout\Model\LayoutTheme';

    /**
     * @var string
     */
    protected $name =  'layout_theme';

    /**
     * @var array
     */
    protected $column = array(
		'theme_id'=>1,
		'name'=>1,
		'parent_theme_id'=>1,
		'super_theme_id'=>1,
		'author'=>1,
		'is_active'=>1,
		'is_editing'=>1,
		'is_default'=>1,
		'variable_params'=>1,
		'template_id'=>1,
		'description'=>1,
		'screen_shorts'=>1,
		'version'=>1,
		'vendor_id'=>1);

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
     * @return \Layout\Model\LayoutTheme
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