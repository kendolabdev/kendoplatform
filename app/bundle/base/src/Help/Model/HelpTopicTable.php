<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_help_topic`
 */

namespace Help\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class HelpTopicTable
 *
 * @package Help\Model
 */
class HelpTopicTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_help_topic`
     * @var string
     */
    protected $class =  '\Help\Model\HelpTopic';

    /**
     * @var string
     */
    protected $name =  'help_topic';

    /**
     * @var array
     */
    protected $column = array(
		'topic_id'=>1,
		'category_id'=>1,
		'topic_active'=>1,
		'topic_sort_order'=>1,
		'topic_title'=>1,
		'topic_slug'=>1,
		'topic_description'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'topic_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'topic_id';

    
    /**
     * @param  string|int $value
     * @return \Help\Model\HelpTopic
     */
    public function findById($value){
       return $this->select()
           ->where('topic_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('topic_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}