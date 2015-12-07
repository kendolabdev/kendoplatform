<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_event_category`
 */

namespace Event\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class EventCategoryTable
 *
 * @package Event\Model
 */
class EventCategoryTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_event_category`
     * @var string
     */
    protected $class =  '\Event\Model\EventCategory';

    /**
     * @var string
     */
    protected $name =  'event_category';

    /**
     * @var array
     */
    protected $column = array(
		'category_id'=>1,
		'category_name'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'category_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'category_id';

    
    /**
     * @param  string|int $value
     * @return \Event\Model\EventCategory
     */
    public function findById($value){
       return $this->select()
           ->where('category_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('category_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}