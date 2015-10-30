<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_attribute_catalog`
 */

namespace Attribute\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class AttributeCatalogTable
 * @package Attribute\Model
 */
class AttributeCatalogTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_attribute_catalog`
     * @var string
     */
    protected $class =  '\Attribute\Model\AttributeCatalog';

    /**
     * @var string
     */
    protected $name =  'attribute_catalog';

    /**
     * @var array
     */
    protected $column = array(
		'catalog_id'=>1,
		'catalog_code'=>1,
		'catalog_name'=>1,
		'content_id'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'catalog_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'catalog_id';

    
    /**
     * @param  string|int $value
     * @return \Attribute\Model\AttributeCatalog
     */
    public function findById($value){
       return $this->select()
           ->where('catalog_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('catalog_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}