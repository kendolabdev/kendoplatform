<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_invitation`
 */

namespace Platform\Invitation\Model;

/**
 */
use Kendo\Model;

/**
 * Class Platform\Invitation
 *
 * @package Platform\Invitation\Model
 */
class Invitation extends Model
{
    /**
     * @return array
     */
    public function toTokenArray()
    {
        return ['type' => $this->getType(), 'id' => $this->getId()];
    }

    /**
     * @return string
     */
    public function toHtml()
    {

        $attrs = [
            'id'   => $this->getId(),
            'type' => $this->getType(),
        ];

        return app()->viewHelper()->partial('platform/invitation/partial/invitation-item', [
            'headline' => $this->getHeadline(),
            'poster'   => $this->getPoster(),
            'parent'   => $this->getParent(),
            'item'     => $this,
            'attrs'    => $attrs,
        ]);
    }

    /**
     * @return string
     */
    public function getHeadline()
    {
        $msg = 'invitation_headline.' . $this->getTypeId();

        return app()->twig()
            ->renderHeadline($msg, [
                'poster' => $this->getPoster(),
                'parent' => $this->getParent(),
            ]);
    }

    /**
     * @return string
     */
    public function toHref()
    {
        return '';
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'invitation';
    }

    /**
     * @return \Kendo\Content\PosterInterface
     */
    public function getPoster()
    {
        return app()->find($this->getPosterType(), $this->getPosterId());
    }

    /**
     * @return \Kendo\Content\PosterInterface
     */
    public function getParent()
    {
        return app()->find($this->getParentType(), $this->getParentId());
    }

    /**
     * @return \Kendo\Content\ContentInterface
     */
    public function getObject()
    {
        return app()->find($this->getObjectType(), $this->getObjectId());
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
    public function getTypeId(){
       return $this->__get('type_id');
    }

    /**
     * @param $value
     */
    public function setTypeId($value){
       $this->__set('type_id', $value);
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
    public function getParentId(){
       return $this->__get('parent_id');
    }

    /**
     * @param $value
     */
    public function setParentId($value){
       $this->__set('parent_id', $value);
    }

    /**
     * @return null|string
     */
    public function getParentUserId(){
       return $this->__get('parent_user_id');
    }

    /**
     * @param $value
     */
    public function setParentUserId($value){
       $this->__set('parent_user_id', $value);
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
    public function getParentType(){
       return $this->__get('parent_type');
    }

    /**
     * @param $value
     */
    public function setParentType($value){
       $this->__set('parent_type', $value);
    }

    /**
     * @return null|string
     */
    public function getObjectId(){
       return $this->__get('object_id');
    }

    /**
     * @param $value
     */
    public function setObjectId($value){
       $this->__set('object_id', $value);
    }

    /**
     * @return null|string
     */
    public function getObjectType(){
       return $this->__get('object_type');
    }

    /**
     * @param $value
     */
    public function setObjectType($value){
       $this->__set('object_type', $value);
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
    public function getParams(){
       return $this->__get('params');
    }

    /**
     * @param $value
     */
    public function setParams($value){
       $this->__set('params', $value);
    }

    /**
     * @return null|string
     */
    public function getRead(){
       return $this->__get('read');
    }

    /**
     * @param $value
     */
    public function setRead($value){
       $this->__set('read', $value);
    }

    /**
     * @return null|string
     */
    public function getMitigated(){
       return $this->__get('mitigated');
    }

    /**
     * @param $value
     */
    public function setMitigated($value){
       $this->__set('mitigated', $value);
    }

    /**
     * @return \Platform\Invitation\Model\InvitationTable
     */
    public function table(){
        return app()->table('platform_invitation');
    }
    //END_TABLE_GENERATOR
}