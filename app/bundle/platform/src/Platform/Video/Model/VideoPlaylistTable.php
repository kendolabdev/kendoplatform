<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_video_playlist`
 */

namespace Platform\Video\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class VideoPlaylistTable
 *
 * @package Video\Model
 */
class VideoPlaylistTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_video_playlist`
     * @var string
     */
    protected $class =  '\Platform\Video\Model\VideoPlaylist';

    /**
     * @var string
     */
    protected $name =  'platform_video_playlist';

    /**
     * @var array
     */
    protected $column = array(
		'playlist_id'=>1,
		'poster_id'=>1,
		'user_id'=>1,
		'parent_id'=>1,
		'parent_user_id'=>1,
		'poster_type'=>1,
		'parent_type'=>1,
		'playlist_title'=>1,
		'created_at'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'playlist_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'playlist_id';

    
    /**
     * @param  string|int $value
     * @return \Platform\Video\Model\VideoPlaylist
     */
    public function findById($value){
       return $this->select()
           ->where('playlist_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('playlist_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}