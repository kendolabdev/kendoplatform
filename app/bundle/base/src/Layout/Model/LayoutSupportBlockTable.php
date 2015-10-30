<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_layout_support_block`
 */

namespace Layout\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class LayoutSupportBlockTable
 *
 * @package Layout\Model
 */
class LayoutSupportBlockTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_layout_support_block`
     * @var string
     */
    protected $class =  '\Layout\Model\LayoutSupportBlock';

    /**
     * @var string
     */
    protected $name =  'layout_support_block';

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
     * @return \Layout\Model\LayoutSupportBlock
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