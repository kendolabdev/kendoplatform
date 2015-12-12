<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_photo_album`
 */

namespace Platform\Photo\Model;

/**
 */
use Kendo\Content\ContentInterface;
use Kendo\Content\TraitBaseContent;
use Kendo\Model;

/**
 * Class Platform\PhotoAlbum
 *
 * @package Platform\Photo\Model
 */
class PhotoAlbum extends Model implements ContentInterface
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
     * onBeforeInsertPhotoAlbum
     * onBeforeDeletePhotoAlbum
     * onAfterInsertPhotoAlbum
     * onAfterDeletePhotoAlbum
     *
     * @var string
     */
    protected $_signalKey = 'PhotoAlbum';

    /**
     * @param array $params
     *
     * @return string
     */
    public function toHref($params = [])
    {
        $params['id'] = $this->getId();
        $params['slug'] = \App::toSlug($this->getTitle());

        return \App::routingService()->getUrl('photo_album_view', $params);
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        $title = $this->getName();

        if (empty($title)) {
            $title = 'Untitled - ' . date('M D, Y', strtotime($this->getCreatedAt()));
        }

        return $title;
    }


    /**
     * @param array $params
     *
     * @return string
     */
    public function toHtml($params = [])
    {
        return '';
    }


    /**
     * @return string
     */
    public function getType()
    {
        return 'photo.photo_album';
    }

    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->__get('album_id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('album_id', $value);
    }

    /**
     * @return null|string
     */
    public function getAlbumId()
    {
        return $this->__get('album_id');
    }

    /**
     * @param $value
     */
    public function setAlbumId($value)
    {
        $this->__set('album_id', $value);
    }

    /**
     * @return null|string
     */
    public function getPosterId()
    {
        return $this->__get('poster_id');
    }

    /**
     * @param $value
     */
    public function setPosterId($value)
    {
        $this->__set('poster_id', $value);
    }

    /**
     * @return null|string
     */
    public function getUserId()
    {
        return $this->__get('user_id');
    }

    /**
     * @param $value
     */
    public function setUserId($value)
    {
        $this->__set('user_id', $value);
    }

    /**
     * @return null|string
     */
    public function getParentId()
    {
        return $this->__get('parent_id');
    }

    /**
     * @param $value
     */
    public function setParentId($value)
    {
        $this->__set('parent_id', $value);
    }

    /**
     * @return null|string
     */
    public function getParentUserId()
    {
        return $this->__get('parent_user_id');
    }

    /**
     * @param $value
     */
    public function setParentUserId($value)
    {
        $this->__set('parent_user_id', $value);
    }

    /**
     * @return null|string
     */
    public function getStory()
    {
        return $this->__get('story');
    }

    /**
     * @param $value
     */
    public function setStory($value)
    {
        $this->__set('story', $value);
    }

    /**
     * @return null|string
     */
    public function getAlbumType()
    {
        return $this->__get('album_type');
    }

    /**
     * @param $value
     */
    public function setAlbumType($value)
    {
        $this->__set('album_type', $value);
    }

    /**
     * @return null|string
     */
    public function getPosterType()
    {
        return $this->__get('poster_type');
    }

    /**
     * @param $value
     */
    public function setPosterType($value)
    {
        $this->__set('poster_type', $value);
    }

    /**
     * @return null|string
     */
    public function getParentType()
    {
        return $this->__get('parent_type');
    }

    /**
     * @param $value
     */
    public function setParentType($value)
    {
        $this->__set('parent_type', $value);
    }

    /**
     * @return null|string
     */
    public function getPhotoFileId()
    {
        return $this->__get('photo_file_id');
    }

    /**
     * @param $value
     */
    public function setPhotoFileId($value)
    {
        $this->__set('photo_file_id', $value);
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->__get('name');
    }

    /**
     * @param $value
     */
    public function setName($value)
    {
        $this->__set('name', $value);
    }

    /**
     * @return null|string
     */
    public function getContent()
    {
        return $this->__get('content');
    }

    /**
     * @param $value
     */
    public function setContent($value)
    {
        $this->__set('content', $value);
    }

    /**
     * @return null|string
     */
    public function getCreatedAt()
    {
        return $this->__get('created_at');
    }

    /**
     * @param $value
     */
    public function setCreatedAt($value)
    {
        $this->__set('created_at', $value);
    }

    /**
     * @return null|string
     */
    public function getModifiedAt()
    {
        return $this->__get('modified_at');
    }

    /**
     * @param $value
     */
    public function setModifiedAt($value)
    {
        $this->__set('modified_at', $value);
    }

    /**
     * @return null|string
     */
    public function getFollowCount()
    {
        return $this->__get('follow_count');
    }

    /**
     * @param $value
     */
    public function setFollowCount($value)
    {
        $this->__set('follow_count', $value);
    }

    /**
     * @return null|string
     */
    public function getCommentCount()
    {
        return $this->__get('comment_count');
    }

    /**
     * @param $value
     */
    public function setCommentCount($value)
    {
        $this->__set('comment_count', $value);
    }

    /**
     * @return null|string
     */
    public function getLikeCount()
    {
        return $this->__get('like_count');
    }

    /**
     * @param $value
     */
    public function setLikeCount($value)
    {
        $this->__set('like_count', $value);
    }

    /**
     * @return null|string
     */
    public function getPhotoCount()
    {
        return $this->__get('photo_count');
    }

    /**
     * @param $value
     */
    public function setPhotoCount($value)
    {
        $this->__set('photo_count', $value);
    }

    /**
     * @return null|string
     */
    public function getPrivacyType()
    {
        return $this->__get('privacy_type');
    }

    /**
     * @param $value
     */
    public function setPrivacyType($value)
    {
        $this->__set('privacy_type', $value);
    }

    /**
     * @return null|string
     */
    public function getPrivacyValue()
    {
        return $this->__get('privacy_value');
    }

    /**
     * @param $value
     */
    public function setPrivacyValue($value)
    {
        $this->__set('privacy_value', $value);
    }

    /**
     * @return null|string
     */
    public function getPrivacyText()
    {
        return $this->__get('privacy_text');
    }

    /**
     * @param $value
     */
    public function setPrivacyText($value)
    {
        $this->__set('privacy_text', $value);
    }

    /**
     * @return null|string
     */
    public function getPeopleCount()
    {
        return $this->__get('people_count');
    }

    /**
     * @param $value
     */
    public function setPeopleCount($value)
    {
        $this->__set('people_count', $value);
    }

    /**
     * @return null|string
     */
    public function getPlaceId()
    {
        return $this->__get('place_id');
    }

    /**
     * @param $value
     */
    public function setPlaceId($value)
    {
        $this->__set('place_id', $value);
    }

    /**
     * @return null|string
     */
    public function getPlaceType()
    {
        return $this->__get('place_type');
    }

    /**
     * @param $value
     */
    public function setPlaceType($value)
    {
        $this->__set('place_type', $value);
    }

    /**
     * @return null|string
     */
    public function getShareCount()
    {
        return $this->__get('share_count');
    }

    /**
     * @param $value
     */
    public function setShareCount($value)
    {
        $this->__set('share_count', $value);
    }

    /**
     * @return \Platform\Photo\Model\PhotoAlbumTable
     */
    public function table()
    {
        return \App::table('platform_photo_album');
    }
    //END_TABLE_GENERATOR
}