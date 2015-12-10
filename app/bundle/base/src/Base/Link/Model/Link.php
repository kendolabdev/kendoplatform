<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_link`
 */

namespace Base\Link\Model;

/**
 */
use Kendo\Content\ContentInterface;
use Kendo\Content\TraitBaseContent;
use Kendo\Model;
use Kendo\View\View;

/**
 * Class Base\Link
 *
 * @package Base\Link\Model
 */
class Link extends Model implements
    ContentInterface
{

    use TraitBaseContent;

    /**
     * @param array $params
     *
     * @return string
     */
    public function toHtml($params = [])
    {
        $params['link'] = $this;

        return (new View('/base/link/partial/attachment-link', $params))->render();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'link';
    }

    /**
     * @return bool
     */
    public function hasThumbnail()
    {
        return null != $this->getThumbnailUrl();
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function toHref($params = [])
    {
        $params['id'] = $this->getId();

        return \App::routingService()->getUrl('blog_view', $params);
    }


    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('link_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('link_id', $value);
    }

    /**
     * @return null|string
     */
    public function getLinkId(){
       return $this->__get('link_id');
    }

    /**
     * @param $value
     */
    public function setLinkId($value){
       $this->__set('link_id', $value);
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
    public function getOriginUrl(){
       return $this->__get('origin_url');
    }

    /**
     * @param $value
     */
    public function setOriginUrl($value){
       $this->__set('origin_url', $value);
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
    public function getThumbnailWidth(){
       return $this->__get('thumbnail_width');
    }

    /**
     * @param $value
     */
    public function setThumbnailWidth($value){
       $this->__set('thumbnail_width', $value);
    }

    /**
     * @return null|string
     */
    public function getLinkType(){
       return $this->__get('link_type');
    }

    /**
     * @param $value
     */
    public function setLinkType($value){
       $this->__set('link_type', $value);
    }

    /**
     * @return null|string
     */
    public function getThumbnailHeight(){
       return $this->__get('thumbnail_height');
    }

    /**
     * @param $value
     */
    public function setThumbnailHeight($value){
       $this->__set('thumbnail_height', $value);
    }

    /**
     * @return \Base\Link\Model\LinkTable
     */
    public function table(){
        return \App::table('base_link');
    }
    //END_TABLE_GENERATOR
}