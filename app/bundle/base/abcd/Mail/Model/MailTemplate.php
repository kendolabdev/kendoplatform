<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_mail_template`
 */

namespace Mail\Model;

/**
 */
use Kendo\Model;

/**
 * Class MailTemplate
 *
 * @package Mail\Model
 */
class MailTemplate extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('template_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('template_id', $value);
    }

    /**
     * @return null|string
     */
    public function getTemplateId(){
       return $this->__get('template_id');
    }

    /**
     * @param $value
     */
    public function setTemplateId($value){
       $this->__set('template_id', $value);
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
    public function getTitle(){
       return $this->__get('title');
    }

    /**
     * @param $value
     */
    public function setTitle($value){
       $this->__set('title', $value);
    }

    /**
     * @return null|string
     */
    public function getTemplateName(){
       return $this->__get('template_name');
    }

    /**
     * @param $value
     */
    public function setTemplateName($value){
       $this->__set('template_name', $value);
    }

    /**
     * @return null|string
     */
    public function getSubjectDefault(){
       return $this->__get('subject_default');
    }

    /**
     * @param $value
     */
    public function setSubjectDefault($value){
       $this->__set('subject_default', $value);
    }

    /**
     * @return null|string
     */
    public function getBodyTextDefault(){
       return $this->__get('body_text_default');
    }

    /**
     * @param $value
     */
    public function setBodyTextDefault($value){
       $this->__set('body_text_default', $value);
    }

    /**
     * @return null|string
     */
    public function getBodyHtmlDefault(){
       return $this->__get('body_html_default');
    }

    /**
     * @param $value
     */
    public function setBodyHtmlDefault($value){
       $this->__set('body_html_default', $value);
    }

    /**
     * @return \Mail\Model\MailTemplateTable
     */
    public function table(){
        return \App::table('mail.mail_template');
    }
    //END_TABLE_GENERATOR
}