<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_feed_status`
 */

namespace Feed\Model;

/**
 */
use Picaso\Content\Attachable;
use Picaso\Content\CanComment;
use Picaso\Content\CanLike;
use Picaso\Content\CanShare;
use Picaso\Content\CanTagPeople;
use Picaso\Content\CanTagPlace;
use Picaso\Content\Content;
use Picaso\Content\HasPrivacy;
use Picaso\Content\HasStory;
use Picaso\Content\ImpBaseContent;
use Picaso\Content\ImpCanTagPeople;
use Picaso\Content\ImpCanTagPlace;
use Picaso\Content\ImpHasPrivacy;
use Picaso\Content\UniqueId;
use Picaso\Model;
use Picaso\View\View;

/**
 * Class ActivityStatus
 *
 * @package Feed\Model
 */
class FeedStatus extends Model
    implements UniqueId,
    Content,
    Attachable,
    CanTagPlace,
    CanTagPeople,
    CanComment,
    CanLike,
    CanShare,
    HasPrivacy,
    HasStory
{
    use ImpBaseContent, ImpCanTagPlace, ImpCanTagPeople, ImpHasPrivacy;

    /**
     * @var string
     *
     * onBeforeInsertContent
     * onBeforeDeleteContent
     * onAfterInsertContent
     * onAfterDeleteContent
     *
     */
    protected $_signalGroup = 'Content';

    /**
     * Notify method
     *
     * onBeforeInsertStatus
     * onBeforeDeleteStatus
     * onAfterInsertStatus
     * onAfterDeleteStatus
     *
     * @var string
     */
    protected $_signalKey = 'Status';

    /**
     * @return string
     */
    public function getContent()
    {
        return (string)$this->getStory();
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return \App::text('core.post');
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function toHref($params = [])
    {
        $params['type'] = $this->getType();

        $params['id'] = $this->getId();

        return \App::routingService()->getRoute('feed_detail', $params);
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function toHtml($params = [])
    {
        $place = $this->getPlace();


        if ($place instanceof Attachable) {
            return $place->toHtml();
        } else {
            $params['poster'] = $this->getPoster();
            $params['status'] = $this;

            return (new View('/base/feed/partial/attachment-status', $params))->render();
        }

    }


    /**
     * @return string
     */
    public function getType()
    {
        return 'feed.feed_status';
    }

    /**
     * @return string
     */
    public function getModuleId()
    {
        return 'feed';
    }

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('status_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('status_id', $value);
    }

    /**
     * @return null|string
     */
    public function getStatusId(){
       return $this->__get('status_id');
    }

    /**
     * @param $value
     */
    public function setStatusId($value){
       $this->__set('status_id', $value);
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
    public function getStory(){
       return $this->__get('story');
    }

    /**
     * @param $value
     */
    public function setStory($value){
       $this->__set('story', $value);
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
    public function getPeopleCount(){
       return $this->__get('people_count');
    }

    /**
     * @param $value
     */
    public function setPeopleCount($value){
       $this->__set('people_count', $value);
    }

    /**
     * @return null|string
     */
    public function getPlaceType(){
       return $this->__get('place_type');
    }

    /**
     * @param $value
     */
    public function setPlaceType($value){
       $this->__set('place_type', $value);
    }

    /**
     * @return null|string
     */
    public function getPlaceId(){
       return $this->__get('place_id');
    }

    /**
     * @param $value
     */
    public function setPlaceId($value){
       $this->__set('place_id', $value);
    }

    /**
     * @return \Feed\Model\FeedStatusTable
     */
    public function table(){
        return \App::table('feed.feed_status');
    }
    //END_TABLE_GENERATOR
}