<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_phrase_value`
 */

namespace Platform\Phrase\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class ValueTable
 * @package Platform\Phrase\Model
 */
class ValueTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_phrase_value`
     * @var string
     */
    protected $class =  '\Platform\Phrase\Model\Value';

    /**
     * @var string
     */
    protected $name =  'platform_phrase_value';

    /**
     * @var array
     */
    protected $column = array(
		'phrase_id'=>1,
		'language_id'=>1,
		'phrase_value'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'phrase_id'=>1, 'language_id'=>1);

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