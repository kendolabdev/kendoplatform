<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_phrase_language`
 */

namespace Phrase\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class PhraseLanguageTable
 *
 * @package Phrase\Model
 */
class PhraseLanguageTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_phrase_language`
     * @var string
     */
    protected $class =  '\Phrase\Model\PhraseLanguage';

    /**
     * @var string
     */
    protected $name =  'phrase_language';

    /**
     * @var array
     */
    protected $column = array(
		'id'=>1,
		'name'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Phrase\Model\PhraseLanguage
     */
    public function findById($value){
       return $this->select()
           ->where('id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}