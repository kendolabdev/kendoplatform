<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_mail_item`
 */

namespace Platform\Mail\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class ItemTable
 * @package Platform\Mail\Model
 */
class ItemTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_mail_item`
     * @var string
     */
    protected $class =  '\Platform\Mail\Model\Item';

    /**
     * @var string
     */
    protected $name =  'platform_mail_item';

    /**
     * @var array
     */
    protected $column = array(
		'id'=>1,
		'is_sent'=>1,
		'priority'=>1,
		'subject'=>1,
		'body_text'=>1,
		'body_html'=>1,
		'created_at'=>1);

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
     * @return \Platform\Mail\Model\Item
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