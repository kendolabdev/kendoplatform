<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_help_page`
 */

namespace Help\Model;

/**
 */
use Picaso\Content\UniqueId;
use Picaso\Model;

/**
 * Class HelpPage
 *
 * @package Help\Model
 */
class HelpPage extends Model implements UniqueId
{

    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->getPageTitle();
    }

    /**
     * @return null|string
     */
    public function getContent()
    {
        return $this->getPageContent();
    }

    /**
     * @return null|string
     */
    public function getDescription()
    {
        return $this->getPageDescription();
    }

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('page_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('page_id', $value);
    }

    /**
     * @return null|string
     */
    public function getPageId(){
       return $this->__get('page_id');
    }

    /**
     * @param $value
     */
    public function setPageId($value){
       $this->__set('page_id', $value);
    }

    /**
     * @return null|string
     */
    public function getPageActive(){
       return $this->__get('page_active');
    }

    /**
     * @param $value
     */
    public function setPageActive($value){
       $this->__set('page_active', $value);
    }

    /**
     * @return null|string
     */
    public function getSortOrder(){
       return $this->__get('sort_order');
    }

    /**
     * @param $value
     */
    public function setSortOrder($value){
       $this->__set('sort_order', $value);
    }

    /**
     * @return null|string
     */
    public function getPageSlug(){
       return $this->__get('page_slug');
    }

    /**
     * @param $value
     */
    public function setPageSlug($value){
       $this->__set('page_slug', $value);
    }

    /**
     * @return null|string
     */
    public function getRedirectTo(){
       return $this->__get('redirect_to');
    }

    /**
     * @param $value
     */
    public function setRedirectTo($value){
       $this->__set('redirect_to', $value);
    }

    /**
     * @return null|string
     */
    public function getPageTitle(){
       return $this->__get('page_title');
    }

    /**
     * @param $value
     */
    public function setPageTitle($value){
       $this->__set('page_title', $value);
    }

    /**
     * @return null|string
     */
    public function getPageContent(){
       return $this->__get('page_content');
    }

    /**
     * @param $value
     */
    public function setPageContent($value){
       $this->__set('page_content', $value);
    }

    /**
     * @return null|string
     */
    public function getPageDescription(){
       return $this->__get('page_description');
    }

    /**
     * @param $value
     */
    public function setPageDescription($value){
       $this->__set('page_description', $value);
    }

    /**
     * @return null|string
     */
    public function getUpdatedAt(){
       return $this->__get('updated_at');
    }

    /**
     * @param $value
     */
    public function setUpdatedAt($value){
       $this->__set('updated_at', $value);
    }

    /**
     * @return \Help\Model\HelpPageTable
     */
    public function table(){
        return \App::table('help.help_page');
    }
    //END_TABLE_GENERATOR
}