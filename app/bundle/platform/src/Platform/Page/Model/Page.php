<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_page`
 */

namespace Platform\Page\Model;

/**
 */
use Platform\Page\ViewHelper\ButtonMemberCount;
use Platform\Page\ViewHelper\ButtonMembership;
use Kendo\Content\TraitBaseContent;
use Kendo\Content\TraitBasePoster;
use Kendo\Content\PosterInterface;
use Kendo\Model;

/**
 * Class Page
 *
 * @package Page\Model
 */
class Page extends Model implements PosterInterface
{
    use TraitBasePoster, TraitBaseContent;

    /**
     * @var string
     *
     * onBeforeInsertPoster
     * onBeforeDeletePoster
     * onAfterInsertPoster
     * onAfterDeletePoster
     *
     */
    protected $_signalGroup = 'Poster';

    /**
     * Notify method
     *
     * onBeforeInsertPage
     * onBeforeDeletePage
     * onAfterInsertPage
     * onAfterDeletePage
     *
     * @var string
     */
    protected $_signalKey = 'Page';

    /**
     * @return string
     */
    public function btnMemberCount()
    {
        return (new ButtonMemberCount())->__invoke($this);
    }

    /**
     * @return string
     */
    public function btnMembership()
    {
        return (new ButtonMembership())->__invoke($this);
    }

    /**
     * @return string
     */
    public function getModuleName()
    {
        return 'page';
    }


    /**
     * before insert checking
     */
    public function _beforeInsert()
    {
        parent::_beforeInsert();

        if (null == $this->__get('profile_name')) {
            $this->setProfileName(uniqid('page-'));
        }
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->__get('name');
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function toHtml($params = [])
    {

    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function toHref($params = [])
    {
        if (null != $this->getProfileName()) {
            $params['name'] = $this->getProfileName();

            return \App::routingService()->getUrl('page_slug', $params);
        } else {
            $params['profileId'] = $this->getId();

            return \App::routingService()->getUrl('page_profile', $params);
        }
    }


    /**
     * @return string
     */
    public function getType()
    {
        return 'page';
    }

    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->__get('page_id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('page_id', $value);
    }

    /**
     * @return null|string
     */
    public function getPageId()
    {
        return $this->__get('page_id');
    }

    /**
     * @param $value
     */
    public function setPageId($value)
    {
        $this->__set('page_id', $value);
    }

    /**
     * @return null|string
     */
    public function isPublished()
    {
        return $this->__get('is_published');
    }

    /**
     * @return null|string
     */
    public function getPublished()
    {
        return $this->__get('is_published');
    }

    /**
     * @param $value
     */
    public function setPublished($value)
    {
        $this->__set('is_published', $value);
    }

    /**
     * @return null|string
     */
    public function isActive()
    {
        return $this->__get('is_active');
    }

    /**
     * @return null|string
     */
    public function getActive()
    {
        return $this->__get('is_active');
    }

    /**
     * @param $value
     */
    public function setActive($value)
    {
        $this->__set('is_active', $value);
    }

    /**
     * @return null|string
     */
    public function isApproved()
    {
        return $this->__get('is_approved');
    }

    /**
     * @return null|string
     */
    public function getApproved()
    {
        return $this->__get('is_approved');
    }

    /**
     * @param $value
     */
    public function setApproved($value)
    {
        $this->__set('is_approved', $value);
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
    public function getProfileName()
    {
        return $this->__get('profile_name');
    }

    /**
     * @param $value
     */
    public function setProfileName($value)
    {
        $this->__set('profile_name', $value);
    }

    /**
     * @return null|string
     */
    public function getSlug()
    {
        return $this->__get('slug');
    }

    /**
     * @param $value
     */
    public function setSlug($value)
    {
        $this->__set('slug', $value);
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
    public function getMemberCount()
    {
        return $this->__get('member_count');
    }

    /**
     * @param $value
     */
    public function setMemberCount($value)
    {
        $this->__set('member_count', $value);
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
    public function getRoleId()
    {
        return $this->__get('role_id');
    }

    /**
     * @param $value
     */
    public function setRoleId($value)
    {
        $this->__set('role_id', $value);
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
     * @return \Platform\Page\Model\PageTable
     */
    public function table()
    {
        return \App::table('platform_page');
    }
    //END_TABLE_GENERATOR
}