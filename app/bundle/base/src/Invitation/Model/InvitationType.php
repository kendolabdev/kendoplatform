<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_invitation_type`
 */

namespace Invitation\Model;

/**
 */
use Picaso\Model;

/**
 * Class InvitationType
 *
 * @package Invitation\Model
 */
class InvitationType extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('id', $value);
    }

    /**
     * @return null|string
     */
    public function getHandler(){
       return $this->__get('handler');
    }

    /**
     * @param $value
     */
    public function setHandler($value){
       $this->__set('handler', $value);
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
    public function isPush(){
       return $this->__get('is_push');
    }

    /**
     * @return null|string
     */
    public function getPush(){
       return $this->__get('is_push');
    }

    /**
     * @param $value
     */
    public function setPush($value){
       $this->__set('is_push', $value);
    }

    /**
     * @return null|string
     */
    public function isMail(){
       return $this->__get('is_mail');
    }

    /**
     * @return null|string
     */
    public function getMail(){
       return $this->__get('is_mail');
    }

    /**
     * @param $value
     */
    public function setMail($value){
       $this->__set('is_mail', $value);
    }

    /**
     * @return null|string
     */
    public function isSms(){
       return $this->__get('is_sms');
    }

    /**
     * @return null|string
     */
    public function getSms(){
       return $this->__get('is_sms');
    }

    /**
     * @param $value
     */
    public function setSms($value){
       $this->__set('is_sms', $value);
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
    public function getShowOnUserConfig(){
       return $this->__get('show_on_user_config');
    }

    /**
     * @param $value
     */
    public function setShowOnUserConfig($value){
       $this->__set('show_on_user_config', $value);
    }

    /**
     * @return \Invitation\Model\InvitationTypeTable
     */
    public function table(){
        return \App::table('invitation.invitation_type');
    }
    //END_TABLE_GENERATOR
}