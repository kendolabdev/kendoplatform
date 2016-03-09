<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_share`
 */

namespace Platform\Share\Model;

/**
 */
use Kendo\Content\ContentInterface;
use Kendo\Content\TraitBaseContent;
use Kendo\Model;
use Kendo\View\View;

/**
 * Class Share
 *
 * @package Share\Model
 */
class Share extends Model implements ContentInterface
{
    use TraitBaseContent;

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
     * onBeforeInsertShare
     * onBeforeDeleteShare
     * onAfterInsertShare
     * onAfterDeleteShare
     *
     * @var string
     */
    protected $_signalKey = 'Share';

    /**
     * @return string
     */
    public function getTitle()
    {
        return app()->text('post');
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function toHref($params = [])
    {
        $params['id'] = $this->getId();
        $params['type'] = $this->getType();

        return app()->routing()->getUrl('feed_detail', $params);
    }

    /**
     * @return ContentInterface
     */
    public function getAbout()
    {
        return app()->find($this->getAboutType(), $this->getAboutId());
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function toHtml($params = [])
    {
        $params['share'] = $this;
        $params['attachment'] = $about = $this->getAbout();

        if ($about && $about->getType() != 'activity.story') {
//            $params['story'] = app()->find('activity.story', $about->getStoryId());
        }

        return (new View('platform/share/partial/attachment-share', $params))->render();
    }


    /**
     * @return string
     */
    public function getType()
    {
        return 'share';
    }

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('share_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('share_id', $value);
    }

    /**
     * @return null|string
     */
    public function getShareId(){
       return $this->__get('share_id');
    }

    /**
     * @param $value
     */
    public function setShareId($value){
       $this->__set('share_id', $value);
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
    public function getFeedId(){
       return $this->__get('feed_id');
    }

    /**
     * @param $value
     */
    public function setFeedId($value){
       $this->__set('feed_id', $value);
    }

    /**
     * @return null|string
     */
    public function getParentShareId(){
       return $this->__get('parent_share_id');
    }

    /**
     * @param $value
     */
    public function setParentShareId($value){
       $this->__set('parent_share_id', $value);
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
    public function getAboutId(){
       return $this->__get('about_id');
    }

    /**
     * @param $value
     */
    public function setAboutId($value){
       $this->__set('about_id', $value);
    }

    /**
     * @return null|string
     */
    public function getAboutType(){
       return $this->__get('about_type');
    }

    /**
     * @param $value
     */
    public function setAboutType($value){
       $this->__set('about_type', $value);
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
    public function getParamsText(){
       return $this->__get('params_text');
    }

    /**
     * @param $value
     */
    public function setParamsText($value){
       $this->__set('params_text', $value);
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
     * @return \Platform\Share\Model\ShareTable
     */
    public function table(){
        return app()->table('platform_share');
    }
    //END_TABLE_GENERATOR
}