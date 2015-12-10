<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_catalog_section_map`
 */

namespace Platform\Catalog\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class SectionMapTable
 * @package Platform\Catalog\Model
 */
class SectionMapTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_catalog_section_map`
     * @var string
     */
    protected $class =  '\Platform\Catalog\Model\SectionMap';

    /**
     * @var string
     */
    protected $name =  'platform_catalog_section_map';

    /**
     * @var array
     */
    protected $column = array(
		'map_id'=>1,
		'catalog_id'=>1,
		'section_id'=>1,
		'sort_order'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'map_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'map_id';

    
    /**
     * @param  string|int $value
     * @return \Platform\Catalog\Model\SectionMap
     */
    public function findById($value){
       return $this->select()
           ->where('map_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('map_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}