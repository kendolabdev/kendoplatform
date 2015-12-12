<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_layout_template`
 */

namespace Platform\Layout\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\LayoutTemplateTable
 *
 * @package Platform\Layout\Model
 */
class LayoutTemplateTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_layout_template`
     * @var string
     */
    protected $class =  '\Platform\Layout\Model\LayoutTemplate';

    /**
     * @var string
     */
    protected $name =  'platform_layout_template';

    /**
     * @var array
     */
    protected $column = array(
		'template_id'=>1,
		'template_name'=>1,
		'parent_template_id'=>1,
		'super_template_id'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'template_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Platform\Layout\Model\LayoutTemplate
     */
    public function findById($value){
       return $this->select()
           ->where('template_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('template_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}