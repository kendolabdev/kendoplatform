<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_notification_type`
 */

namespace Notification\Model;

/**
 */
use Picaso\Model;

/**
 * Class NotificationType
 *
 * @package Notification\Model
 */
class NotificationType extends Model
{
    /**
     * @return string
     */
    public function getTitle()
    {
        return \App::text('notification_label.' . $this->getId());
    }

    /**
     * @return string
     */
    public function getAdminTitle()
    {
        return \App::text('notification_admin_label.' . $this->getId());
    }

    /**
     * @return string
     */
    public function getGroupTitle()
    {
        return \App::text('notification_group_label.' . $this->getNotificationGroup());
    }

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
    public function getNotificationGroup(){
       return $this->__get('notification_group');
    }

    /**
     * @param $value
     */
    public function setNotificationGroup($value){
       $this->__set('notification_group', $value);
    }

    /**
     * @return null|string
     */
    public function getUserEdit(){
       return $this->__get('user_edit');
    }

    /**
     * @param $value
     */
    public function setUserEdit($value){
       $this->__set('user_edit', $value);
    }

    /**
     * @return \Notification\Model\NotificationTypeTable
     */
    public function table(){
        return \App::table('notification.notification_type');
    }
    //END_TABLE_GENERATOR
}