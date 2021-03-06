<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_tag_people`
 */

namespace Platform\Tag\Model;

/**
 */
use Kendo\Db\DbTable;
use Kendo\Db\Exception;

/**
 * Class Base\TagPeopleTable
 *
 * @package Base\Tag\Model
 */
class TagPeopleTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_tag_people`
     * @var string
     */
    protected $class =  '\Platform\Tag\Model\TagPeople';

    /**
     * @var string
     */
    protected $name =  'platform_tag_people';

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