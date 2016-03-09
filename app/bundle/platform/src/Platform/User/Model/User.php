<?php

/**
 * @author   Nam Nguyen <namnv@younetco.com>
 * @version  1.0.1
 * @category younet
 * @package  core
 */

namespace Platform\User\Model;

use Kendo\Content\CatalogInterface;
use Kendo\Content\TraitBaseContent;
use Kendo\Content\TraitBasePoster;
use Kendo\Content\PosterInterface;
use Kendo\Model;
use Platform\User\ViewHelper\ButtonMemberCount;
use Platform\User\ViewHelper\ButtonMembership;

/**
 * Class Platform\User
 *
 * @package Platform\User\Model
 */
class User extends Model implements PosterInterface, CatalogInterface
{
    use TraitBasePoster, TraitBaseContent;

    /**
     * @var string
     *
     * onBeforeInsertPoster
     * onBeforeDeletePoster
     * onAfterInsertPoster
     * onAfterDeletePoster
     *
     */
    protected $_signalGroup = 'Poster';

    /**
     * Notify method
     *
     * onBeforeInsertUser
     * onBeforeDeleteUser
     * onAfterInsertUser
     * onAfterDeleteUser
     *
     * @var string
     */
    protected $_signalKey = 'User';

    /**
     * @param null $dataType
     *
     * @return \Kendo\Db\DbTable
     */
    public function getAttributeValueTable($dataType = null)
    {
        return app()->table('platform_user_attribute_value');
    }


    /**
     * @return string
     */
    public function btnMemberCount()
    {
        return (new ButtonMemberCount())->__invoke($this);
    }

    /**
     * @return string
     */
    public function btnMembership()
    {
        return (new ButtonMembership())->__invoke($this);
    }


    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->__get('name');
    }

    /**
     * @return string
     */
    public function getModuleName()
    {
        return 'platform_user';
    }


    /**
     * @return \Platform\Acl\Model\AclRole
     */
    public function getRole()
    {
        return app()->table('platform_acl_role')
            ->findById($this->getRoleId());
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function toHref($params = [])
    {

        if ($this->getProfileName()) {
            $params['name'] = $this->getProfileName();

            return app()->routing()->getUrl('profile', $params);
        } else {
            $params['name'] = $this->getId();

            return app()->routing()->getUrl('user_profile', $params);
        }
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->getId();
    }

    /**
     * @return string
     */
    public function getParentType()
    {
        return $this->getType();
    }

    /**
     * @return int
     */
    public function getParentUserId()
    {
        return $this->getId();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'platform_user';
    }

    /**
     * @return string
     */
    public function getModuleId()
    {
        return 'platform_user';
    }

    /**
     * @return int
     */
    public function getPosterId()
    {
        return $this->getId();
    }

    /**
     * @return string
     */
    public function getPosterType()
    {
        return $this->getType();
    }

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('user_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('user_id', $value);
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
    public function isPublished(){
       return $this->__get('is_published');
    }

    /**
     * @return null|string
     */
    public function getPublished(){
       return $this->__get('is_published');
    }

    /**
     * @param $value
     */
    public function setPublished($value){
       $this->__set('is_published', $value);
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
    public function isVerified(){
       return $this->__get('is_verified');
    }

    /**
     * @return null|string
     */
    public function getVerified(){
       return $this->__get('is_verified');
    }

    /**
     * @param $value
     */
    public function setVerified($value){
       $this->__set('is_verified', $value);
    }

    /**
     * @return null|string
     */
    public function isApproved(){
       return $this->__get('is_approved');
    }

    /**
     * @return null|string
     */
    public function getApproved(){
       return $this->__get('is_approved');
    }

    /**
     * @param $value
     */
    public function setApproved($value){
       $this->__set('is_approved', $value);
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
    public function getPhotoFileId(){
       return $this->__get('photo_file_id');
    }

    /**
     * @param $value
     */
    public function setPhotoFileId($value){
       $this->__set('photo_file_id', $value);
    }

    /**
     * @return null|string
     */
    public function getName(){
       return $this->__get('name');
    }

    /**
     * @param $value
     */
    public function setName($value){
       $this->__set('name', $value);
    }

    /**
     * @return null|string
     */
    public function getProfileName(){
       return $this->__get('profile_name');
    }

    /**
     * @param $value
     */
    public function setProfileName($value){
       $this->__set('profile_name', $value);
    }

    /**
     * @return null|string
     */
    public function getEmail(){
       return $this->__get('email');
    }

    /**
     * @param $value
     */
    public function setEmail($value){
       $this->__set('email', $value);
    }

    /**
     * @return null|string
     */
    public function getGender(){
       return $this->__get('gender');
    }

    /**
     * @param $value
     */
    public function setGender($value){
       $this->__set('gender', $value);
    }

    /**
     * @return null|string
     */
    public function getModifiedAt(){
       return $this->__get('modified_at');
    }

    /**
     * @param $value
     */
    public function setModifiedAt($value){
       $this->__set('modified_at', $value);
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
    public function getCommentCount(){
       return $this->__get('comment_count');
    }

    /**
     * @param $value
     */
    public function setCommentCount($value){
       $this->__set('comment_count', $value);
    }

    /**
     * @return null|string
     */
    public function getShareCount(){
       return $this->__get('share_count');
    }

    /**
     * @param $value
     */
    public function setShareCount($value){
       $this->__set('share_count', $value);
    }

    /**
     * @return null|string
     */
    public function getMemberCount(){
       return $this->__get('member_count');
    }

    /**
     * @param $value
     */
    public function setMemberCount($value){
       $this->__set('member_count', $value);
    }

    /**
     * @return null|string
     */
    public function getLikeCount(){
       return $this->__get('like_count');
    }

    /**
     * @param $value
     */
    public function setLikeCount($value){
       $this->__set('like_count', $value);
    }

    /**
     * @return null|string
     */
    public function getFollowCount(){
       return $this->__get('follow_count');
    }

    /**
     * @param $value
     */
    public function setFollowCount($value){
       $this->__set('follow_count', $value);
    }

    /**
     * @return null|string
     */
    public function getPrivacyType(){
       return $this->__get('privacy_type');
    }

    /**
     * @param $value
     */
    public function setPrivacyType($value){
       $this->__set('privacy_type', $value);
    }

    /**
     * @return null|string
     */
    public function getPrivacyValue(){
       return $this->__get('privacy_value');
    }

    /**
     * @param $value
     */
    public function setPrivacyValue($value){
       $this->__set('privacy_value', $value);
    }

    /**
     * @return null|string
     */
    public function getPrivacyText(){
       return $this->__get('privacy_text');
    }

    /**
     * @param $value
     */
    public function setPrivacyText($value){
       $this->__set('privacy_text', $value);
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
     * @return \Platform\User\Model\UserTable
     */
    public function table(){
        return app()->table('platform_user');
    }
    //END_TABLE_GENERATOR
}