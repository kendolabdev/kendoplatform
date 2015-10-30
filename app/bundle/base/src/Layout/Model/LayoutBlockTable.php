<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_layout_block`
 */

namespace Layout\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class LayoutBlockTable
 *
 * @package Layout\Model
 */
class LayoutBlockTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_layout_block`
     * @var string
     */
    protected $class =  '\Layout\Model\LayoutBlock';

    /**
     * @var string
     */
    protected $name =  'layout_block';

    /**
     * @var array
     */
    protected $column = array(
		'block_id'=>1,
		'parent_block_id'=>1,
		'section_id'=>1,
		'node_id'=>1,
		'leaf_id'=>1,
		'support_block_id'=>1,
		'block_order'=>1,
		'block_params_text'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'block_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Layout\Model\LayoutBlock
     */
    public function findById($value){
       return $this->select()
           ->where('block_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('block_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}