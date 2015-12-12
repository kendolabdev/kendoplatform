<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_phrase_language`
 */

namespace Platform\Phrase\Model;

/**
 */
use Kendo\Model;

/**
 * Class Platform\PhraseLanguage
 *
 * @package Platform\Phrase\Model
 */
class PhraseLanguage extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('id', $value);
    }

    /**
     * @return null|string
     */
    public function getName(){
       return $this->__get('name');
    }

    /**
     * @param $value
     */
    public function setName($value){
       $this->__set('name', $value);
    }

    /**
     * @return \Platform\Phrase\Model\PhraseLanguageTable
     */
    public function table(){
        return \App::table('platform_phrase_language');
    }
    //END_TABLE_GENERATOR
}