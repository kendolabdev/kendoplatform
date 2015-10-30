<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_tag_people`
 */

namespace Tag\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class TagPeopleTable
 *
 * @package Tag\Model
 */
class TagPeopleTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_tag_people`
     * @var string
     */
    protected $class =  '\Tag\Model\TagPeople';

    /**
     * @var string
     */
    protected $name =  'tag_people';

    /**
     * @var array
     */
    protected $column = array(
		'content_id'=>1,
		'poster_id'=>1,
		'content_type'=>1,
		'poster_type'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'content_id'=>1, 'poster_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return null
     * @throws \Picaso\Db\Exception
     */
    public function findById($value){
       throw new \Picaso\Db\Exception('Can not find by id for '.$value);
    }

    //END_TABLE_GENERATOR
}