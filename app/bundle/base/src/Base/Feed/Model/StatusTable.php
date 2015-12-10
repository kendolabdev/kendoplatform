<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_base_feed_status`
 */

namespace Base\Feed\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class StatusTable
 * @package Base\Feed\Model
 */
class StatusTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_base_feed_status`
     * @var string
     */
    protected $class =  '\Base\Feed\Model\Status';

    /**
     * @var string
     */
    protected $name =  'base_feed_status';

    /**
     * @var array
     */
    protected $column = array(
		'status_id'=>1,
		'poster_id'=>1,
		'user_id'=>1,
		'parent_id'=>1,
		'parent_user_id'=>1,
		'poster_type'=>1,
		'parent_type'=>1,
		'like_count'=>1,
		'comment_count'=>1,
		'share_count'=>1,
		'story'=>1,
		'created_at'=>1,
		'modified_at'=>1,
		'privacy_type'=>1,
		'privacy_value'=>1,
		'privacy_text'=>1,
		'people_count'=>1,
		'place_type'=>1,
		'place_id'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'status_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Base\Feed\Model\Status
     */
    public function findById($value){
       return $this->select()
           ->where('status_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('status_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}