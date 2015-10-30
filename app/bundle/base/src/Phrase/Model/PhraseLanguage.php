<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_phrase_language`
 */

namespace Phrase\Model;

/**
 */
use Picaso\Model;

/**
 * Class PhraseLanguage
 *
 * @package Phrase\Model
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
     * @return \Phrase\Model\PhraseLanguageTable
     */
    public function table(){
        return \App::table('phrase.phrase_language');
    }
    //END_TABLE_GENERATOR
}