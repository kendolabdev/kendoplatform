<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_phrase_value`
 */

namespace Platform\Phrase\Model;

/**
 */
use Kendo\Model;

/**
 * Class Platform\PhraseValue
 *
 * @package Platform\Phrase\Model
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
     * @return \Platform\Phrase\Model\PhraseValueTable
     */
    public function table(){
        return \App::table('platform_phrase_value');
    }
    //END_TABLE_GENERATOR
}