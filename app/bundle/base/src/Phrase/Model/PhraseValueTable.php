<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_phrase_value`
 */

namespace Phrase\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class PhraseValueTable
 *
 * @package Phrase\Model
 */
class PhraseValueTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_phrase_value`
     * @var string
     */
    protected $class =  '\Phrase\Model\PhraseValue';

    /**
     * @var string
     */
    protected $name =  'phrase_value';

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
     * @throws \Picaso\Db\Exception
     */
    public function findById($value){
       throw new \Picaso\Db\Exception('Can not find by id for '.$value);
    }

    //END_TABLE_GENERATOR
}