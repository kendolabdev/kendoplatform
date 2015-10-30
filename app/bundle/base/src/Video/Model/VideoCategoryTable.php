<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_video_category`
 */

namespace Video\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class VideoCategoryTable
 *
 * @package Video\Model
 */
class VideoCategoryTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_video_category`
     * @var string
     */
    protected $class =  '\Video\Model\VideoCategory';

    /**
     * @var string
     */
    protected $name =  'video_category';

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
     * @return \Video\Model\VideoCategory
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