<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_photo_album`
 */

namespace Photo\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class PhotoAlbumTable
 *
 * @package Photo\Model
 */
class PhotoAlbumTable extends DbTable
{
	// PUT YOUR CODE HERE

	//START_TABLE_GENERATOR

    /**
     * @see `Kendo_photo_album`
     * @var string
     */
    protected $class =  '\Photo\Model\PhotoAlbum';

    /**
     * @var string
     */
    protected $name =  'photo_album';

    /**
     * @var array
     */
    protected $column = array(
		'album_id'=>1,
		'poster_id'=>1,
		'user_id'=>1,
		'parent_id'=>1,
		'parent_user_id'=>1,
		'story'=>1,
		'album_type'=>1,
		'poster_type'=>1,
		'parent_type'=>1,
		'photo_file_id'=>1,
		'name'=>1,
		'content'=>1,
		'created_at'=>1,
		'modified_at'=>1,
		'follow_count'=>1,
		'comment_count'=>1,
		'like_count'=>1,
		'photo_count'=>1,
		'privacy_type'=>1,
		'privacy_value'=>1,
		'privacy_text'=>1,
		'people_count'=>1,
		'place_id'=>1,
		'place_type'=>1,
		'share_count'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'album_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Photo\Model\PhotoAlbum
     */
    public function findById($value){
       return $this->select()
           ->where('album_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('album_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}