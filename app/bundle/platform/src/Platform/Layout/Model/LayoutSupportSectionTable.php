<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_layout_support_section`
 */

namespace Platform\Layout\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\LayoutSupportSectionTable
 *
 * @package Platform\Layout\Model
 */
class LayoutSupportSectionTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_layout_support_section`
     * @var string
     */
    protected $class =  '\Platform\Layout\Model\LayoutSupportSection';

    /**
     * @var string
     */
    protected $name =  'platform_layout_support_section';

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
     * @return \Platform\Layout\Model\LayoutSupportSection
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