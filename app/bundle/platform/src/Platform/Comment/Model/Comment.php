<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_comment`
 */

namespace Platform\Comment\Model;

/**
 */
use Kendo\Content\AtomInterface;
use Kendo\Content\TraitBaseContent;
use Kendo\Model;

/**
 * Class Base\Comment
 *
 * @package Base\Comment\Model
 */
class Comment extends Model implements AtomInterface
{
    use TraitBaseContent;

    /**
     * Notify method
     *
     * onBeforeInsertComment
     * onBeforeDeleteComment
     * onAfterInsertComment
     * onAfterDeleteComment
     *
     * @var string
     */
    protected $_signalKey = 'Comment';


    /**
     * @return string
     */
    public function getType()
    {
        return 'comment';
    }

    /**
     * @return \Kendo\Content\PosterInterface
     */
    public function getPoster()
    {
        return \App::find($this->getPosterType(), $this->getPosterId());
    }

    /**
     * @return \Kendo\Content\AttachableInterface
     */
    public function getAttachment()
    {
        return \App::find($this->getAttachmentType(), $this->getAttachmentId());
    }

    /**
     * @return \Kendo\Content\ContentInterface
     */
    public function getAbout()
    {
        return \App::find($this->getAboutType(), $this->getAboutId());
    }

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('comment_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('comment_id', $value);
    }

    /**
     * @return null|string
     */
    public function getCommentId(){
       return $this->__get('comment_id');
    }

    /**
     * @param $value
     */
    public function setCommentId($value){
       $this->__set('comment_id', $value);
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
    public function getAttachmentType(){
       return $this->__get('attachment_type');
    }

    /**
     * @param $value
     */
    public function setAttachmentType($value){
       $this->__set('attachment_type', $value);
    }

    /**
     * @return null|string
     */
    public function getAttachmentId(){
       return $this->__get('attachment_id');
    }

    /**
     * @param $value
     */
    public function setAttachmentId($value){
       $this->__set('attachment_id', $value);
    }

    /**
     * @return \Platform\Comment\Model\CommentTable
     */
    public function table(){
        return \App::table('platform_comment');
    }
    //END_TABLE_GENERATOR
}