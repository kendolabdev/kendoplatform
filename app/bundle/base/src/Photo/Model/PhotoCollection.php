<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_photo_collection`
 */

namespace Photo\Model;

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
 * Class PhotoCollection
 *
 * @package Photo\Model
 */
class PhotoCollection extends Model
    implements UniqueId,
    Attachable,
    Content,
    HasPrivacy,
    HasStory,
    CanComment,
    CanLike,
    CanShare,
    CanTagPeople,
    CanTagPlace
{
    use ImpBaseContent, ImpHasPrivacy, ImpCanTagPeople, ImpCanTagPlace;

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
     * onBeforeInsertPhotoCollection
     * onBeforeDeletePhotoCollection
     * onAfterInsertPhotoCollection
     * onAfterDeletePhotoCollection
     *
     * @var string
     */
    protected $_signalKey = 'PhotoCollection';

    /**
     * @param array $params
     *
     * @return string
     */
    public function toHref($params = [])
    {
        return '#';
    }

    /**
     *
     */
    public function updatePhotoCount()
    {
        $total = \App::table('photo')
            ->select()
            ->where('collection_id=?', $this->getId())
            ->count();

        $this->setPhotoCount($total);
        $this->save();

        return $total;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return 'photos';
    }


    /**
     * @param int $limit
     *
     * @return array
     */
    public function getPhotoForFeedAttachments($limit)
    {
        return \App::table('photo')
            ->select()
            ->where('collection_id=?', $this->getId())
            ->order('created_at', 1)
            ->limit($limit, 0)
            ->all();
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function toHtml($params = [])
    {
        $total = $this->getPhotoCount();

        if (!$total) {
            $total = $this->updatePhotoCount();
        }

        $params ['collection'] = $this;
        $params ['photos'] = $photos = $this->getPhotoForFeedAttachments(5);
        $params ['remain'] = '';
        $params['total'] = $total;
        $params ['count'] = $count = count($photos);

        if (($remain = $total - $count) > 0) {
            $params['remain'] = '<div class="more"><div><div>+' . $remain . '</div></div></div>';
        }

        return (new View('/base/photo/partial/attachment-photo-collection', $params))->render();
    }


    /**
     * @return string
     */
    public function getType()
    {
        return 'photo.photo_collection';
    }


    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('collection_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('collection_id', $value);
    }

    /**
     * @return null|string
     */
    public function getCollectionId(){
       return $this->__get('collection_id');
    }

    /**
     * @param $value
     */
    public function setCollectionId($value){
       $this->__set('collection_id', $value);
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
    public function getPhotoCount(){
       return $this->__get('photo_count');
    }

    /**
     * @param $value
     */
    public function setPhotoCount($value){
       $this->__set('photo_count', $value);
    }

    /**
     * @return null|string
     */
    public function getAlbumId(){
       return $this->__get('album_id');
    }

    /**
     * @param $value
     */
    public function setAlbumId($value){
       $this->__set('album_id', $value);
    }

    /**
     * @return null|string
     */
    public function getContent(){
       return $this->__get('content');
    }

    /**
     * @param $value
     */
    public function setContent($value){
       $this->__set('content', $value);
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
     * @return \Photo\Model\PhotoCollectionTable
     */
    public function table(){
        return \App::table('photo.photo_collection');
    }
    //END_TABLE_GENERATOR
}