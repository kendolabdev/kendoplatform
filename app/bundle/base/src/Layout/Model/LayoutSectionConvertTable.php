<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_layout_section_convert`
 */

namespace Layout\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class LayoutSectionConvertTable
 * @package Layout\Model
 */
class LayoutSectionConvertTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_layout_section_convert`
     * @var string
     */
    protected $class =  '\Layout\Model\LayoutSectionConvert';

    /**
     * @var string
     */
    protected $name =  'layout_section_convert';

    /**
     * @var array
     */
    protected $column = array(
		'conver_id'=>1,
		'template_id'=>1,
		'from_id'=>1,
		'to_id'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'conver_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'conver_id';

    
    /**
     * @param  string|int $value
     * @return \Layout\Model\LayoutSectionConvert
     */
    public function findById($value){
       return $this->select()
           ->where('conver_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('conver_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}