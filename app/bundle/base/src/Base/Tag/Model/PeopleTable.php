<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_base_tag_people`
 */

namespace Base\Tag\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class PeopleTable
 * @package Base\Tag\Model
 */
class PeopleTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_base_tag_people`
     * @var string
     */
    protected $class =  '\Base\Tag\Model\People';

    /**
     * @var string
     */
    protected $name =  'base_tag_people';

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
     * @throws \Kendo\Db\Exception
     */
    public function findById($value){
       throw new \Kendo\Db\Exception('Can not find by id for '.$value);
    }

    //END_TABLE_GENERATOR
}