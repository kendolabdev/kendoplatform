<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_layout_support_section`
 */

namespace Layout\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class LayoutSupportSectionTable
 *
 * @package Layout\Model
 */
class LayoutSupportSectionTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_layout_support_section`
     * @var string
     */
    protected $class =  '\Layout\Model\LayoutSupportSection';

    /**
     * @var string
     */
    protected $name =  'layout_support_section';

    /**
     * @var array
     */
    protected $column = array(
		'support_section_id'=>1,
		'support_section_name'=>1,
		'support_section_order'=>1,
		'support_section_type'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'support_section_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Layout\Model\LayoutSupportSection
     */
    public function findById($value){
       return $this->select()
           ->where('support_section_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('support_section_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}