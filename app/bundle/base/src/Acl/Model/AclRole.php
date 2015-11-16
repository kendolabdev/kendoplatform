<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_acl_role`
 */

namespace Acl\Model;

/**
 */
use Picaso\Model;

/**
 * Class AclRole
 *
 * @package Acl\Model
 */
class AclRole extends Model
{

    /**
     * @return array
     */
    public function getListAncestorId()
    {
        $result = [$this->getId()];
        $item = $this;

        while (null != ($item = $item->getParentRole())) {
            $result[] = $item->getId();
        }

        return $result;
    }

    /**
     * @return \Acl\Model\AclRole
     */
    public function getParentRole()
    {
        return \App::table('acl.acl_role')
            ->findById($this->getParentRoleId());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getTitle();
    }

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('role_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('role_id', $value);
    }

    /**
     * @return null|string
     */
    public function getRoleId(){
       return $this->__get('role_id');
    }

    /**
     * @param $value
     */
    public function setRoleId($value){
       $this->__set('role_id', $value);
    }

    /**
     * @return null|string
     */
    public function getParentRoleId(){
       return $this->__get('parent_role_id');
    }

    /**
     * @param $value
     */
    public function setParentRoleId($value){
       $this->__set('parent_role_id', $value);
    }

    /**
     * @return null|string
     */
    public function getRoleType(){
       return $this->__get('role_type');
    }

    /**
     * @param $value
     */
    public function setRoleType($value){
       $this->__set('role_type', $value);
    }

    /**
     * @return null|string
     */
    public function isSystem(){
       return $this->__get('is_system');
    }

    /**
     * @return null|string
     */
    public function getSystem(){
       return $this->__get('is_system');
    }

    /**
     * @param $value
     */
    public function setSystem($value){
       $this->__set('is_system', $value);
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
    public function isSuper(){
       return $this->__get('is_super');
    }

    /**
     * @return null|string
     */
    public function getSuper(){
       return $this->__get('is_super');
    }

    /**
     * @param $value
     */
    public function setSuper($value){
       $this->__set('is_super', $value);
    }

    /**
     * @return null|string
     */
    public function isAdmin(){
       return $this->__get('is_admin');
    }

    /**
     * @return null|string
     */
    public function getAdmin(){
       return $this->__get('is_admin');
    }

    /**
     * @param $value
     */
    public function setAdmin($value){
       $this->__set('is_admin', $value);
    }

    /**
     * @return null|string
     */
    public function isModerator(){
       return $this->__get('is_moderator');
    }

    /**
     * @return null|string
     */
    public function getModerator(){
       return $this->__get('is_moderator');
    }

    /**
     * @param $value
     */
    public function setModerator($value){
       $this->__set('is_moderator', $value);
    }

    /**
     * @return null|string
     */
    public function isMember(){
       return $this->__get('is_member');
    }

    /**
     * @return null|string
     */
    public function getMember(){
       return $this->__get('is_member');
    }

    /**
     * @param $value
     */
    public function setMember($value){
       $this->__set('is_member', $value);
    }

    /**
     * @return null|string
     */
    public function isGuest(){
       return $this->__get('is_guest');
    }

    /**
     * @return null|string
     */
    public function getGuest(){
       return $this->__get('is_guest');
    }

    /**
     * @param $value
     */
    public function setGuest($value){
       $this->__set('is_guest', $value);
    }

    /**
     * @return \Acl\Model\AclRoleTable
     */
    public function table(){
        return \App::table('acl.acl_role');
    }
    //END_TABLE_GENERATOR
}