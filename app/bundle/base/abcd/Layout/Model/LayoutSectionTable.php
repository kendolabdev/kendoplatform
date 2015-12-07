<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_layout_section`
 */

namespace Layout\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class LayoutSectionTable
 *
 * @package Layout\Model
 */
class LayoutSectionTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_layout_section`
     * @var string
     */
    protected $class =  '\Layout\Model\LayoutSection';

    /**
     * @var string
     */
    protected $name =  'layout_section';

    /**
     * @var array
     */
    protected $column = array(
		'section_id'=>1,
		'layout_id'=>1,
		'section_order'=>1,
		'section_active'=>1,
		'section_type'=>1,
		'section_template'=>1,
		'section_params_text'=>1,
		'container_type'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'section_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Layout\Model\LayoutSection
     */
    public function findById($value){
       return $this->select()
           ->where('section_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('section_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}