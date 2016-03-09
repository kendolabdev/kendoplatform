<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_video_category`
 */

namespace Platform\Video\Model;

/**
 */
use Kendo\Db\DbTable;

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
     * @see `picaso_platform_video_category`
     * @var string
     */
    protected $class =  '\Platform\Video\Model\VideoCategory';

    /**
     * @var string
     */
    protected $name =  'platform_video_category';

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
     * @return \Platform\Video\Model\VideoCategory
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