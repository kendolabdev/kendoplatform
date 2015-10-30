<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_place`
 */

namespace Place\Model;

/**
 */
use Picaso\Content\Attachable;
use Picaso\Content\Content;
use Picaso\Content\ImpBaseContent;
use Picaso\Content\UniqueId;
use Picaso\Model;

/**
 * Class Place
 *
 * @package Place\Model
 */
class Place extends Model implements UniqueId, Content, Attachable
{
    use ImpBaseContent;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getName();
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function toHtml($params = [])
    {
        return \App::viewHelper()->partial('base/place/partial/attachment-place', [
            'photoUrl' => $this->getMapPhotoUrl(),
            'place'    => $this,
        ]);
    }

    /**
     * get map photo url
     */
    public function getMapPhotoUrl()
    {
        $params = [
            'size'    => '640x360',
            //            'scale'=>'2',
            'center'  => $this->getLatitude() . ',' . $this->getLongitude(),
            'zoom'    => '14',
            'markers' => 'color:red|' . 'label:ned',
        ];

        return 'https://maps.googleapis.com/maps/api/staticmap?' . http_build_query($params, null, '&amp;');

    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function toHref($params = [])
    {
        // TODO: Implement toHref() method.
    }


    /**
     * @return string
     */
    public function getType()
    {
        return 'place';
    }

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('place_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('place_id', $value);
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
    public function getGoogleId(){
       return $this->__get('google_id');
    }

    /**
     * @param $value
     */
    public function setGoogleId($value){
       $this->__set('google_id', $value);
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
    public function getAddress(){
       return $this->__get('address');
    }

    /**
     * @param $value
     */
    public function setAddress($value){
       $this->__set('address', $value);
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
    public function getLatitude(){
       return $this->__get('latitude');
    }

    /**
     * @param $value
     */
    public function setLatitude($value){
       $this->__set('latitude', $value);
    }

    /**
     * @return null|string
     */
    public function getLongitude(){
       return $this->__get('longitude');
    }

    /**
     * @param $value
     */
    public function setLongitude($value){
       $this->__set('longitude', $value);
    }

    /**
     * @return \Place\Model\PlaceTable
     */
    public function table(){
        return \App::table('place');
    }
    //END_TABLE_GENERATOR
}