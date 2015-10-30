<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_attribute_section`
 */

namespace Attribute\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class AttributeSectionTable
 * @package Attribute\Model
 */
class AttributeSectionTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_attribute_section`
     * @var string
     */
    protected $class =  '\Attribute\Model\AttributeSection';

    /**
     * @var string
     */
    protected $name =  'attribute_section';

    /**
     * @var array
     */
    protected $column = array(
		'section_id'=>1,
		'content_id'=>1,
		'section_code'=>1,
		'section_name'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'section_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'section_id';

    
    /**
     * @param  string|int $value
     * @return \Attribute\Model\AttributeSection
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