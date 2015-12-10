<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_report`
 */

namespace Base\Report\Model;

/**
 */
use Kendo\Content\UniqueId;
use Kendo\Model;

/**
 * Class Report
 *
 * @package Report\Model
 */
class Report extends Model implements UniqueId
{
    /**
     * @return \Kendo\Content\PosterInterface
     */
    public function getPoster()
    {
        return \App::find($this->getPosterType(), $this->getPosterId());
    }


    /**
     * @return \Kendo\Content\ContentInterface
     */
    public function getAbout()
    {
        return \App::find($this->getAboutType(), $this->getAboutId());
    }

    /**
     * @return array
     */
    public function toTokenArray()
    {
        return [
            'type' => $this->getType(),
            'id'   => $this->getId(),
        ];
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'report';
    }

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('report_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('report_id', $value);
    }

    /**
     * @return null|string
     */
    public function getReportId(){
       return $this->__get('report_id');
    }

    /**
     * @param $value
     */
    public function setReportId($value){
       $this->__set('report_id', $value);
    }

    /**
     * @return null|string
     */
    public function getPosterType(){
       return $this->__get('poster_type');
    }

    /**
     * @param $value
     */
    public function setPosterType($value){
       $this->__set('poster_type', $value);
    }

    /**
     * @return null|string
     */
    public function getPosterId(){
       return $this->__get('poster_id');
    }

    /**
     * @param $value
     */
    public function setPosterId($value){
       $this->__set('poster_id', $value);
    }

    /**
     * @return null|string
     */
    public function getCategoryId(){
       return $this->__get('category_id');
    }

    /**
     * @param $value
     */
    public function setCategoryId($value){
       $this->__set('category_id', $value);
    }

    /**
     * @return null|string
     */
    public function getAboutType(){
       return $this->__get('about_type');
    }

    /**
     * @param $value
     */
    public function setAboutType($value){
       $this->__set('about_type', $value);
    }

    /**
     * @return null|string
     */
    public function getAboutId(){
       return $this->__get('about_id');
    }

    /**
     * @param $value
     */
    public function setAboutId($value){
       $this->__set('about_id', $value);
    }

    /**
     * @return null|string
     */
    public function getCreatedAt(){
       return $this->__get('created_at');
    }

    /**
     * @param $value
     */
    public function setCreatedAt($value){
       $this->__set('created_at', $value);
    }

    /**
     * @return null|string
     */
    public function getMessage(){
       return $this->__get('message');
    }

    /**
     * @param $value
     */
    public function setMessage($value){
       $this->__set('message', $value);
    }

    /**
     * @return \Base\Report\Model\ReportTable
     */
    public function table(){
        return \App::table('base_report');
    }
    //END_TABLE_GENERATOR
}