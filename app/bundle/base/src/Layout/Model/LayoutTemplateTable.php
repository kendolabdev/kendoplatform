<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_layout_template`
 */

namespace Layout\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class LayoutTemplateTable
 *
 * @package Layout\Model
 */
class LayoutTemplateTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_layout_template`
     * @var string
     */
    protected $class =  '\Layout\Model\LayoutTemplate';

    /**
     * @var string
     */
    protected $name =  'layout_template';

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
     * @return \Layout\Model\LayoutTemplate
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