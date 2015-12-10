<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_catalog_option`
 */

namespace Platform\Catalog\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class OptionTable
 * @package Platform\Catalog\Model
 */
class OptionTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_catalog_option`
     * @var string
     */
    protected $class =  '\Platform\Catalog\Model\Option';

    /**
     * @var string
     */
    protected $name =  'platform_catalog_option';

    /**
     * @var array
     */
    protected $column = array(
		'option_id'=>1,
		'field_id'=>1,
		'option_name'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'option_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'option_id';

    
    /**
     * @param  string|int $value
     * @return \Platform\Catalog\Model\Option
     */
    public function findById($value){
       return $this->select()
           ->where('option_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('option_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}