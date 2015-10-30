<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_attribute_section`
 */

namespace Attribute\Model;

/**
 */
use Picaso\Content\UniqueId;
use Picaso\Model;

/**
 * Class AttributeSection
 *
 * @package Attribute\Model
 */
class AttributeSection extends Model implements UniqueId
{

    /**
     * @return array
     */
    public function getListField()
    {
        return \App::attribute()
            ->getListFieldBySectionId($this->getId());
    }

    /**
     * @return array
     */
    public function getListFieldId()
    {
        $result = [];

        foreach ($this->getListField() as $field) {
            if (!$field instanceof AttributeField) continue;

            $result[] = $field->getId();
        }

        return $result;
    }

    /**
     * @return null|string
     */
    public function getCode()
    {
        return $this->getSectionCode();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'attribute.attribute_section';
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->getSectionName();
    }

    /**
     * @return array
     */
    public function toTokenArray()
    {
        return [
            'id'   => $this->getId(),
            'type' => $this->getType()
        ];
    }

    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->getSectionName();
    }

    /**
     * @return array
     */
    public function toElement()
    {

        $params = [];

        $element = array_merge([
            'plugin'  => 'section',
            'name'    => $this->getCode(),
            'label'   => $this->getName(),
        ], $params);

        return $element;
    }

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('section_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('section_id', $value);
    }

    /**
     * @return null|string
     */
    public function getSectionId(){
       return $this->__get('section_id');
    }

    /**
     * @param $value
     */
    public function setSectionId($value){
       $this->__set('section_id', $value);
    }

    /**
     * @return null|string
     */
    public function getContentId(){
       return $this->__get('content_id');
    }

    /**
     * @param $value
     */
    public function setContentId($value){
       $this->__set('content_id', $value);
    }

    /**
     * @return null|string
     */
    public function getSectionCode(){
       return $this->__get('section_code');
    }

    /**
     * @param $value
     */
    public function setSectionCode($value){
       $this->__set('section_code', $value);
    }

    /**
     * @return null|string
     */
    public function getSectionName(){
       return $this->__get('section_name');
    }

    /**
     * @param $value
     */
    public function setSectionName($value){
       $this->__set('section_name', $value);
    }

    /**
     * @return \Attribute\Model\AttributeSectionTable
     */
    public function table(){
        return \App::table('attribute.attribute_section');
    }
    //END_TABLE_GENERATOR
}