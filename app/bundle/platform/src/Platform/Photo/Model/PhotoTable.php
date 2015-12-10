<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_photo`
 */

namespace Platform\Photo\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\PhotoTable
 *
 * @package Platform\Photo\Model
 */
class PhotoTable extends DbTable
{
	// PUT YOUR CODE HERE

	//START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_photo`
     * @var string
     */
    protected $class =  '\Platform\Photo\Model\Photo';

    /**
     * @var string
     */
    protected $name =  'platform_photo';

    /**
     * @var array
     */
    protected $column = array(
		'photo_id'=>1,
		'album_id'=>1,
		'collection_id'=>1,
		'poster_id'=>1,
		'user_id'=>1,
		'parent_id'=>1,
		'parent_user_id'=>1,
		'poster_type'=>1,
		'parent_type'=>1,
		'photo_file_id'=>1,
		'created_at'=>1,
		'modified_at'=>1,
		'follow_count'=>1,
		'comment_count'=>1,
		'like_count'=>1,
		'title'=>1,
		'content'=>1,
		'privacy_type'=>1,
		'privacy_value'=>1,
		'privacy_text'=>1,
		'story'=>1,
		'share_count'=>1,
		'people_count'=>1,
		'place_type'=>1,
		'place_id'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'photo_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Platform\Photo\Model\Photo
     */
    public function findById($value){
       return $this->select()
           ->where('photo_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('photo_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}