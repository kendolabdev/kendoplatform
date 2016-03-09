<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_catalog_field`
 */

namespace Platform\Catalog\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class CatalogFieldTable
 *
 * @package Platform\Catalog\Model
 */
class CatalogFieldTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_catalog_field`
     * @var string
     */
    protected $class =  '\Platform\Catalog\Model\CatalogField';

    /**
     * @var string
     */
    protected $name =  'platform_catalog_field';

    /**
     * @var array
     */
    protected $column = array(
		'field_id'=>1,
		'field_code'=>1,
		'content_id'=>1,
		'field_name'=>1,
		'plugin_id'=>1,
		'params_text'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'field_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'field_id';

    
    /**
     * @param  string|int $value
     * @return \Platform\Catalog\Model\CatalogField
     */
    public function findById($value){
       return $this->select()
           ->where('field_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('field_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}