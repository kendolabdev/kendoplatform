<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_base_video_playlist_video`
 */

namespace Base\Video\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class PlaylistVideoTable
 * @package Base\Video\Model
 */
class PlaylistVideoTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_base_video_playlist_video`
     * @var string
     */
    protected $class =  '\Base\Video\Model\PlaylistVideo';

    /**
     * @var string
     */
    protected $name =  'base_video_playlist_video';

    /**
     * @var array
     */
    protected $column = array(
		'playlist_id'=>1,
		'video_id'=>1,
		'created_at'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'playlist_id'=>1, 'video_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return null
     * @throws \Kendo\Db\Exception
     */
    public function findById($value){
       throw new \Kendo\Db\Exception('Can not find by id for '.$value);
    }

    //END_TABLE_GENERATOR
}