<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_setting`
 */

namespace Setting\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class SettingTable
 *
 * @package Setting\Model
 */
class SettingTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_setting`
     * @var string
     */
    protected $class =  '\Setting\Model\Setting';

    /**
     * @var string
     */
    protected $name =  'setting';

    /**
     * @var array
     */
    protected $column = array(
		'setting_id'=>1,
		'action_id'=>1,
		'value_text'=>1);

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
     * @return \Setting\Model\Setting
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