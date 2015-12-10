<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_video`
 */

namespace Base\Video\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class VideoTable
 *
 * @package Video\Model
 */
class VideoTable extends DbTable
{
	// PUT YOUR CODE HERE

	//START_TABLE_GENERATOR

    /**
     * @see `picaso_base_video`
     * @var string
     */
    protected $class =  '\Base\Video\Model\Video';

    /**
     * @var string
     */
    protected $name =  'base_video';

    /**
     * @var array
     */
    protected $column = array(
		'video_id'=>1,
		'is_active'=>1,
		'is_approved'=>1,
		'is_publish'=>1,
		'poster_id'=>1,
		'user_id'=>1,
		'parent_id'=>1,
		'parent_user_id'=>1,
		'poster_type'=>1,
		'parent_type'=>1,
		'video_file_id'=>1,
		'photo_file_id'=>1,
		'title'=>1,
		'story'=>1,
		'description'=>1,
		'provider_code'=>1,
		'provider_name'=>1,
		'video_code'=>1,
		'thumb_mode'=>1,
		'thumbnail_url'=>1,
		'thumbnail_small_url'=>1,
		'privacy_type'=>1,
		'privacy_value'=>1,
		'created_at'=>1,
		'modified_at'=>1,
		'follow_count'=>1,
		'comment_count'=>1,
		'like_count'=>1,
		'share_count'=>1,
		'privacy_text'=>1,
		'people_count'=>1,
		'place_id'=>1,
		'place_type'=>1,
		'video_duration'=>1,
		'view_count'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'video_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Base\Video\Model\Video
     */
    public function findById($value){
       return $this->select()
           ->where('video_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('video_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}