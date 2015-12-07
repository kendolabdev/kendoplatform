<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_layout_setting`
 */

namespace Layout\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class LayoutSettingTable
 *
 * @package Layout\Model
 */
class LayoutSettingTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_layout_setting`
     * @var string
     */
    protected $class =  '\Layout\Model\LayoutSetting';

    /**
     * @var string
     */
    protected $name =  'layout_setting';

    /**
     * @var array
     */
    protected $column = array(
		'setting_id'=>1,
		'page_id'=>1,
		'layout_type'=>1,
		'setting_params_text'=>1,
		'screen_size'=>1,
		'is_active'=>1,
		'theme_id'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'setting_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'setting_id';

    
    /**
     * @param  string|int $value
     * @return \Layout\Model\LayoutSetting
     */
    public function findById($value){
       return $this->select()
           ->where('setting_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('setting_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}