<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_help_page`
 */

namespace Help\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class HelpPageTable
 *
 * @package Help\Model
 */
class HelpPageTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_help_page`
     * @var string
     */
    protected $class =  '\Help\Model\HelpPage';

    /**
     * @var string
     */
    protected $name =  'help_page';

    /**
     * @var array
     */
    protected $column = array(
		'page_id'=>1,
		'page_active'=>1,
		'sort_order'=>1,
		'page_slug'=>1,
		'redirect_to'=>1,
		'page_title'=>1,
		'page_content'=>1,
		'page_description'=>1,
		'updated_at'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'page_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'page_id';

    
    /**
     * @param  string|int $value
     * @return \Help\Model\HelpPage
     */
    public function findById($value){
       return $this->select()
           ->where('page_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('page_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}