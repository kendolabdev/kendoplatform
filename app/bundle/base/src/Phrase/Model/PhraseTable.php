<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_phrase`
 */

namespace Phrase\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class PhraseTable
 *
 * @package Phrase\Model
 */
class PhraseTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_phrase`
     * @var string
     */
    protected $class =  '\Phrase\Model\Phrase';

    /**
     * @var string
     */
    protected $name =  'phrase';

    /**
     * @var array
     */
    protected $column = array(
		'phrase_id'=>1,
		'module_name'=>1,
		'is_active'=>1,
		'phrase_group'=>1,
		'phrase_name'=>1,
		'default_value'=>1,
		'is_edited'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'phrase_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'phrase_id';

    
    /**
     * @param  string|int $value
     * @return \Phrase\Model\Phrase
     */
    public function findById($value){
       return $this->select()
           ->where('phrase_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('phrase_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}