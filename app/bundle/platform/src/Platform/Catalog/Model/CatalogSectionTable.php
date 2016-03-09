<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_catalog_section`
 */

namespace Platform\Catalog\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class CatalogSectionTable
 *
 * @package Platform\Catalog\Model
 */
class CatalogSectionTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_catalog_section`
     * @var string
     */
    protected $class =  '\Platform\Catalog\Model\CatalogSection';

    /**
     * @var string
     */
    protected $name =  'platform_catalog_section';

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
     * @return \Platform\Catalog\Model\CatalogSection
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