<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_mail_translate`
 */

namespace Platform\Mail\Model;

/**
 */
use Kendo\Model;

/**
 * Class Platform\MailTranslate
 *
 * @package Platform\Mail\Model
 */
class MailTranslate extends Model
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
    public function getSubject(){
       return $this->__get('subject');
    }

    /**
     * @param $value
     */
    public function setSubject($value){
       $this->__set('subject', $value);
    }

    /**
     * @return null|string
     */
    public function getBodyText(){
       return $this->__get('body_text');
    }

    /**
     * @param $value
     */
    public function setBodyText($value){
       $this->__set('body_text', $value);
    }

    /**
     * @return null|string
     */
    public function getBodyHtml(){
       return $this->__get('body_html');
    }

    /**
     * @param $value
     */
    public function setBodyHtml($value){
       $this->__set('body_html', $value);
    }

    /**
     * @return \Platform\Mail\Model\MailTranslateTable
     */
    public function table(){
        return app()->table('platform_mail_translate');
    }
    //END_TABLE_GENERATOR
}