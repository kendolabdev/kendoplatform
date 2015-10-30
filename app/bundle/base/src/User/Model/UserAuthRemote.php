<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_user_auth_remote`
 */

namespace User\Model;

/**
 */
use Picaso\Model;

/**
 * Class UserAuthRemote
 *
 * @package User\Model
 */
class UserAuthRemote extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('remote_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('remote_id', $value);
    }

    /**
     * @return null|string
     */
    public function getRemoteId(){
       return $this->__get('remote_id');
    }

    /**
     * @param $value
     */
    public function setRemoteId($value){
       $this->__set('remote_id', $value);
    }

    /**
     * @return null|string
     */
    public function getRemoteUid(){
       return $this->__get('remote_uid');
    }

    /**
     * @param $value
     */
    public function setRemoteUid($value){
       $this->__set('remote_uid', $value);
    }

    /**
     * @return null|string
     */
    public function getRemoteService(){
       return $this->__get('remote_service');
    }

    /**
     * @param $value
     */
    public function setRemoteService($value){
       $this->__set('remote_service', $value);
    }

    /**
     * @return null|string
     */
    public function getUserId(){
       return $this->__get('user_id');
    }

    /**
     * @param $value
     */
    public function setUserId($value){
       $this->__set('user_id', $value);
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
     * @return \User\Model\UserAuthRemoteTable
     */
    public function table(){
        return \App::table('user.user_auth_remote');
    }
    //END_TABLE_GENERATOR
}