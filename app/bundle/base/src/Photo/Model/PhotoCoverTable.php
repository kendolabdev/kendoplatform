<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_photo_cover`
 */

namespace Photo\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class PhotoCoverTable
 *
 * @package Photo\Model
 */
class PhotoCoverTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_photo_cover`
     * @var string
     */
    protected $class =  '\Photo\Model\PhotoCover';

    /**
     * @var string
     */
    protected $name =  'photo_cover';

    /**
     * @var array
     */
    protected $column = array(
		'object_id'=>1,
		'object_type'=>1,
		'photo_id'=>1,
		'photo_file_id'=>1,
		'position_top'=>1,
		'created_at'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'object_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Photo\Model\PhotoCover
     */
    public function findById($value){
       return $this->select()
           ->where('object_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('object_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}