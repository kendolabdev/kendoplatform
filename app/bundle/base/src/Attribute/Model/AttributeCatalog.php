<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_attribute_catalog`
 */

namespace Attribute\Model;

/**
 */
use Picaso\Content\UniqueId;
use Picaso\Model;

/**
 * Class AttributeCatalog
 *
 * @package Attribute\Model
 */
class AttributeCatalog extends Model implements UniqueId
{
    /**
     * @return null|string
     */
    public function getCode()
    {
        return $this->getCatalogCode();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'attribute.attribute_catalog';
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
        return $this->getCatalogName();
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->getCatalogName();
    }

    /**
     * @return array
     */
    public function getListSection()
    {
        return \App::attribute()
            ->getListSectionByCatalogId($this->getId());
    }

    /**
     * @return array
     */
    public function getListSectionId()
    {

        $result = [];

        foreach ($this->getListSection() as $section) {
            if (!$section instanceof AttributeSection) continue;
            $result[] = $section->getId();
        }

        return $result;
    }

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('catalog_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('catalog_id', $value);
    }

    /**
     * @return null|string
     */
    public function getCatalogId(){
       return $this->__get('catalog_id');
    }

    /**
     * @param $value
     */
    public function setCatalogId($value){
       $this->__set('catalog_id', $value);
    }

    /**
     * @return null|string
     */
    public function getCatalogCode(){
       return $this->__get('catalog_code');
    }

    /**
     * @param $value
     */
    public function setCatalogCode($value){
       $this->__set('catalog_code', $value);
    }

    /**
     * @return null|string
     */
    public function getCatalogName(){
       return $this->__get('catalog_name');
    }

    /**
     * @param $value
     */
    public function setCatalogName($value){
       $this->__set('catalog_name', $value);
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
     * @return \Attribute\Model\AttributeCatalogTable
     */
    public function table(){
        return \App::table('attribute.attribute_catalog');
    }
    //END_TABLE_GENERATOR
}