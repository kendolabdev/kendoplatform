<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_phrase`
 */

namespace Phrase\Model;

/**
 */
use Kendo\Model;

/**
 * Class Phrase
 *
 * @package Phrase\Model
 */
class Phrase extends Model
{

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->getPhraseGroup() . '.' . $this->getPhraseName();
    }

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('phrase_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('phrase_id', $value);
    }

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
    public function getModuleName(){
       return $this->__get('module_name');
    }

    /**
     * @param $value
     */
    public function setModuleName($value){
       $this->__set('module_name', $value);
    }

    /**
     * @return null|string
     */
    public function isActive(){
       return $this->__get('is_active');
    }

    /**
     * @return null|string
     */
    public function getActive(){
       return $this->__get('is_active');
    }

    /**
     * @param $value
     */
    public function setActive($value){
       $this->__set('is_active', $value);
    }

    /**
     * @return null|string
     */
    public function getPhraseGroup(){
       return $this->__get('phrase_group');
    }

    /**
     * @param $value
     */
    public function setPhraseGroup($value){
       $this->__set('phrase_group', $value);
    }

    /**
     * @return null|string
     */
    public function getPhraseName(){
       return $this->__get('phrase_name');
    }

    /**
     * @param $value
     */
    public function setPhraseName($value){
       $this->__set('phrase_name', $value);
    }

    /**
     * @return null|string
     */
    public function getDefaultValue(){
       return $this->__get('default_value');
    }

    /**
     * @param $value
     */
    public function setDefaultValue($value){
       $this->__set('default_value', $value);
    }

    /**
     * @return null|string
     */
    public function isEdited(){
       return $this->__get('is_edited');
    }

    /**
     * @return null|string
     */
    public function getEdited(){
       return $this->__get('is_edited');
    }

    /**
     * @param $value
     */
    public function setEdited($value){
       $this->__set('is_edited', $value);
    }

    /**
     * @return \Phrase\Model\PhraseTable
     */
    public function table(){
        return \App::table('phrase');
    }
    //END_TABLE_GENERATOR
}