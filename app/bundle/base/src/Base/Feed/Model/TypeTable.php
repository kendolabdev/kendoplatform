<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_base_feed_type`
 */

namespace Base\Feed\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class TypeTable
 * @package Base\Feed\Model
 */
class TypeTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_base_feed_type`
     * @var string
     */
    protected $class =  '\Base\Feed\Model\Type';

    /**
     * @var string
     */
    protected $name =  'base_feed_type';

    /**
     * @var array
     */
    protected $column = array(
		'id'=>1,
		'is_active'=>1,
		'feed_type'=>1,
		'module_name'=>1,
		'show_on_public'=>1,
		'show_on_parent'=>1,
		'show_on_poster'=>1,
		'show_on_main'=>1,
		'can_share'=>1,
		'can_like'=>1,
		'can_comment'=>1,
		'show_on_tagged'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'id'=>1);

    /**
     * @var string
     */
    protected $identity = 'id';

    
    /**
     * @param  string|int $value
     * @return \Base\Feed\Model\Type
     */
    public function findById($value){
       return $this->select()
           ->where('id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}