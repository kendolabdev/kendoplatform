<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_phrase_value`
 */

namespace Phrase\Model;

/**
 */
use Picaso\Model;

/**
 * Class PhraseValue
 *
 * @package Phrase\Model
 */
class PhraseValue extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getPhraseId(){
       return $this->__get('phrase_id');
    }

    /**
     * @param $value
     */
    public function setPhraseId($value){
       $this->__set('phrase_id', $value);
    }

    /**
     * @return null|string
     */
    public function getLanguageId(){
       return $this->__get('language_id');
    }

    /**
     * @param $value
     */
    public function setLanguageId($value){
       $this->__set('language_id', $value);
    }

    /**
     * @return null|string
     */
    public function getPhraseValue(){
       return $this->__get('phrase_value');
    }

    /**
     * @param $value
     */
    public function setPhraseValue($value){
       $this->__set('phrase_value', $value);
    }

    /**
     * @return \Phrase\Model\PhraseValueTable
     */
    public function table(){
        return \App::table('phrase.phrase_value');
    }
    //END_TABLE_GENERATOR
}