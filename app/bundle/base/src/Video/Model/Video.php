<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_video`
 */

namespace Video\Model;

/**
 */
use Picaso\Content\Attachable;
use Picaso\Content\CanComment;
use Picaso\Content\CanLike;
use Picaso\Content\CanShare;
use Picaso\Content\CanTagPeople;
use Picaso\Content\CanTagPlace;
use Picaso\Content\Content;
use Picaso\Content\HasPhoto;
use Picaso\Content\HasPrivacy;
use Picaso\Content\HasStory;
use Picaso\Content\ImpBaseContent;
use Picaso\Content\ImpCanTagPeople;
use Picaso\Content\ImpCanTagPlace;
use Picaso\Content\ImpHasPhoto;
use Picaso\Content\ImpHasPrivacy;
use Picaso\Content\UniqueId;
use Picaso\Model;
use Picaso\View\View;

/**
 * Class Video
 *
 * @package Video\Model
 */
class Video extends Model implements
    UniqueId,
    Content,
    Attachable,
    HasPhoto,
    HasPrivacy,
    HasStory,
    CanComment,
    CanLike,
    CanShare,
    CanTagPeople,
    CanTagPlace
{
    use ImpBaseContent, ImpHasPhoto, ImpHasPrivacy, ImpCanTagPlace, ImpCanTagPeople;

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
     * onBeforeInsertVideo
     * onBeforeDeleteVideo
     * onAfterInsertVideo
     * onAfterDeleteVideo
     *
     * @var string
     */
    protected $_signalKey = 'Video';

    /**
     * @param array $context
     *
     * @return string
     */
    public function getEmbedCode($context)
    {
        return \App::video()->getEmbedCode($this, $context);
    }

    /**
     * @param string $maker
     *
     * @return string
     */
    public function getPhoto($maker)
    {
        if ($maker) ;

        return $this->getThumbnailUrl();

    }

    /**
     * @return string
     */
    public function getDuration()
    {
        return \App::trans()->toDuration($this->getVideoDuration());
    }


    /**
     * @return bool
     */
    public function isExternal()
    {
        $code = $this->getProviderCode();

        return !empty($code) && $code != 'upload';
    }

    /**
     * @param  array $params
     *
     * @return string
     */
    public function toHtml($params = [])
    {
        $params['video'] = $this;

        return (new View('/base/video/partial/attachment-video', $params))->render();
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function toHref($params = [])
    {
        $params['id'] = $this->getId();
        $params['slug'] = \App::toSlug($this->getTitle());

        return \App::routing()->getUrl('video_view', $params);
    }


    /**
     * @return string
     */
    public function getType()
    {
        return 'video';
    }


    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('video_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('video_id', $value);
    }

    /**
     * @return null|string
     */
    public function getVideoId(){
       return $this->__get('video_id');
    }

    /**
     * @param $value
     */
    public function setVideoId($value){
       $this->__set('video_id', $value);
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
    public function isPublish(){
       return $this->__get('is_publish');
    }

    /**
     * @return null|string
     */
    public function getPublish(){
       return $this->__get('is_publish');
    }

    /**
     * @param $value
     */
    public function setPublish($value){
       $this->__set('is_publish', $value);
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
    public function getVideoFileId(){
       return $this->__get('video_file_id');
    }

    /**
     * @param $value
     */
    public function setVideoFileId($value){
       $this->__set('video_file_id', $value);
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
    public function getDescription(){
       return $this->__get('description');
    }

    /**
     * @param $value
     */
    public function setDescription($value){
       $this->__set('description', $value);
    }

    /**
     * @return null|string
     */
    public function getProviderCode(){
       return $this->__get('provider_code');
    }

    /**
     * @param $value
     */
    public function setProviderCode($value){
       $this->__set('provider_code', $value);
    }

    /**
     * @return null|string
     */
    public function getProviderName(){
       return $this->__get('provider_name');
    }

    /**
     * @param $value
     */
    public function setProviderName($value){
       $this->__set('provider_name', $value);
    }

    /**
     * @return null|string
     */
    public function getVideoCode(){
       return $this->__get('video_code');
    }

    /**
     * @param $value
     */
    public function setVideoCode($value){
       $this->__set('video_code', $value);
    }

    /**
     * @return null|string
     */
    public function getThumbMode(){
       return $this->__get('thumb_mode');
    }

    /**
     * @param $value
     */
    public function setThumbMode($value){
       $this->__set('thumb_mode', $value);
    }

    /**
     * @return null|string
     */
    public function getThumbnailUrl(){
       return $this->__get('thumbnail_url');
    }

    /**
     * @param $value
     */
    public function setThumbnailUrl($value){
       $this->__set('thumbnail_url', $value);
    }

    /**
     * @return null|string
     */
    public function getThumbnailSmallUrl(){
       return $this->__get('thumbnail_small_url');
    }

    /**
     * @param $value
     */
    public function setThumbnailSmallUrl($value){
       $this->__set('thumbnail_small_url', $value);
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
    public function getVideoDuration(){
       return $this->__get('video_duration');
    }

    /**
     * @param $value
     */
    public function setVideoDuration($value){
       $this->__set('video_duration', $value);
    }

    /**
     * @return null|string
     */
    public function getViewCount(){
       return $this->__get('view_count');
    }

    /**
     * @param $value
     */
    public function setViewCount($value){
       $this->__set('view_count', $value);
    }

    /**
     * @return \Video\Model\VideoTable
     */
    public function table(){
        return \App::table('video');
    }
    //END_TABLE_GENERATOR
}