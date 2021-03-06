<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_report_general`
 */

namespace Platform\Report\Model;

/**
 */
use Kendo\Content\UniqueId;
use Kendo\Model;

/**
 * Class ReportGeneral
 *
 * @package Report\Model
 */
class ReportGeneral extends Model implements UniqueId
{

    /**
     * @return \Kendo\Content\PosterInterface
     */
    public function getPoster()
    {
        return app()->find($this->getPosterType(), $this->getPosterId());
    }

    /**
     * @return array
     */
    public function toTokenArray()
    {
        return [
            'id'   => $this->getId(),
            'type' => $this->getType(),
        ];

    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'report.report_general';
    }

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('general_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('general_id', $value);
    }

    /**
     * @return null|string
     */
    public function getGeneralId(){
       return $this->__get('general_id');
    }

    /**
     * @param $value
     */
    public function setGeneralId($value){
       $this->__set('general_id', $value);
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
     * @return \Platform\Report\Model\ReportGeneralTable
     */
    public function table(){
        return app()->table('platform_report_general');
    }
    //END_TABLE_GENERATOR
}