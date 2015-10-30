<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_blog_post`
 */

namespace Blog\Model;

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
use Picaso\Content\ImpBaseContent;
use Picaso\Content\ImpCanTagPeople;
use Picaso\Content\ImpCanTagPlace;
use Picaso\Content\ImpHasPrivacy;
use Picaso\Content\UniqueId;
use Picaso\Model;
use Picaso\View\View;

/**
 * Class BlogPost
 *
 * @package Blog\Model
 */
class BlogPost extends Model implements UniqueId,
    Content, Attachable, CanLike, CanShare, CanComment, CanTagPeople, CanTagPlace, HasPrivacy
{
    use ImpBaseContent, ImpHasPrivacy, ImpCanTagPeople, ImpCanTagPlace;

    /**
     * @param array $params
     *
     * @return string
     */
    public function toHtml($params = [])
    {
        $params['post'] = $this;

        return (new View('/base/blog/partial/attachment-post', $params))->render();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'blog.blog_post';
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function toHref($params = [])
    {
        $params['id'] = $this->getId();

        return \App::routing()->getUrl('blog_view', $params);
    }

    /**
     *
     */
    protected function _beforeInsert()
    {
        parent::_beforeInsert();

        if (empty($this->description)) {
            $this->setDescription(substr(strip_tags($this->getContent()), 0, 255));
        }
    }

    /**
     *
     */
    protected function _beforeUpdate()
    {
        parent::_beforeUpdate();

        if (empty($this->description)) {
            $this->setDescription(substr(strip_tags($this->getContent()), 0, 255));
        }
    }

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('post_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('post_id', $value);
    }

    /**
     * @return null|string
     */
    public function getPostId(){
       return $this->__get('post_id');
    }

    /**
     * @param $value
     */
    public function setPostId($value){
       $this->__set('post_id', $value);
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
    public function getSlug(){
       return $this->__get('slug');
    }

    /**
     * @param $value
     */
    public function setSlug($value){
       $this->__set('slug', $value);
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
     * @return \Blog\Model\BlogPostTable
     */
    public function table(){
        return \App::table('blog.blog_post');
    }
    //END_TABLE_GENERATOR
}