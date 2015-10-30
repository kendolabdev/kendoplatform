<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_place`
 */

namespace Place\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class PlaceTable
 *
 * @package Place\Model
 */
class PlaceTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_place`
     * @var string
     */
    protected $class =  '\Place\Model\Place';

    /**
     * @var string
     */
    protected $name =  'place';

    /**
     * @var array
     */
    protected $column = array(
		'place_id'=>1,
		'google_id'=>1,
		'is_published'=>1,
		'is_active'=>1,
		'is_approved'=>1,
		'photo_file_id'=>1,
		'poster_id'=>1,
		'user_id'=>1,
		'parent_id'=>1,
		'parent_user_id'=>1,
		'poster_type'=>1,
		'parent_type'=>1,
		'name'=>1,
		'address'=>1,
		'profile_name'=>1,
		'slug'=>1,
		'created_at'=>1,
		'modified_at'=>1,
		'latitude'=>1,
		'longitude'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'place_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Place\Model\Place
     */
    public function findById($value){
       return $this->select()
           ->where('place_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('place_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}