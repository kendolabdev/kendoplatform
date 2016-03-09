<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_link`
 */

namespace Platform\Link\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Base\LinkTable
 *
 * @package Base\Link\Model
 */
class LinkTable extends DbTable
{
	// PUT YOUR CODE HERE

	//START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_link`
     * @var string
     */
    protected $class =  '\Platform\Link\Model\Link';

    /**
     * @var string
     */
    protected $name =  'platform_link';

    /**
     * @var array
     */
    protected $column = array(
		'link_id'=>1,
		'user_id'=>1,
		'parent_user_id'=>1,
		'poster_id'=>1,
		'poster_type'=>1,
		'parent_id'=>1,
		'parent_type'=>1,
		'like_count'=>1,
		'comment_count'=>1,
		'share_count'=>1,
		'title'=>1,
		'description'=>1,
		'story'=>1,
		'created_at'=>1,
		'modified_at'=>1,
		'privacy_type'=>1,
		'privacy_value'=>1,
		'privacy_text'=>1,
		'people_count'=>1,
		'place_type'=>1,
		'place_id'=>1,
		'provider_name'=>1,
		'origin_url'=>1,
		'thumbnail_url'=>1,
		'thumbnail_width'=>1,
		'link_type'=>1,
		'thumbnail_height'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'link_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Platform\Link\Model\Link
     */
    public function findById($value){
       return $this->select()
           ->where('link_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('link_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}