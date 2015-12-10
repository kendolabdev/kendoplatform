<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_layout_section`
 */

namespace Platform\Layout\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class SectionTable
 * @package Platform\Layout\Model
 */
class SectionTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_layout_section`
     * @var string
     */
    protected $class =  '\Platform\Layout\Model\Section';

    /**
     * @var string
     */
    protected $name =  'platform_layout_section';

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
     * @return \Platform\Layout\Model\Section
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