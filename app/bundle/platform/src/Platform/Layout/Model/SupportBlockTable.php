<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_layout_support_block`
 */

namespace Platform\Layout\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class SupportBlockTable
 * @package Platform\Layout\Model
 */
class SupportBlockTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_layout_support_block`
     * @var string
     */
    protected $class =  '\Platform\Layout\Model\SupportBlock';

    /**
     * @var string
     */
    protected $name =  'platform_layout_support_block';

    /**
     * @var array
     */
    protected $column = array(
		'support_block_id'=>1,
		'block_name'=>1,
		'block_class'=>1,
		'base_path'=>1,
		'item_path'=>1,
		'module_name'=>1,
		'support_block_params_text'=>1,
		'block_type'=>1,
		'editor_class'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'support_block_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'support_block_id';

    
    /**
     * @param  string|int $value
     * @return \Platform\Layout\Model\SupportBlock
     */
    public function findById($value){
       return $this->select()
           ->where('support_block_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('support_block_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}