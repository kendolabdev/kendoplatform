<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_notification`
 */

namespace Platform\Notification\Model;

/**
 */
use Kendo\Model;

/**
 * Class Platform\Notification
 *
 * @package Platform\Notification\Model
 */
class Notification extends Model
{


    /**
     * @return string
     */
    public function toHtml()
    {

        $attrs = [
            'id'   => $this->getId(),
            'type' => $this->getType(),
        ];

        return \App::viewHelper()->partial('platform/notification/partial/notification-item', [
            'headline' => $this->getHeadline(),
            'poster'   => $this->getPoster(),
            'parent'   => $this->getParent(),
            'item'     => $this,
            'attrs'    => $attrs,
        ]);
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'notification';
    }

    /**
     * @return string
     */
    public function toHref()
    {
        return '#';
    }

    /**
     * @return string
     */
    public function getHeadline()
    {
        $msg = 'notification_headline.' . $this->getTypeId();

        return \App::twig()
            ->renderHeadline($msg, [
                'poster' => $this->getPoster(),
                'parent' => $this->getParent(),
                'about'  => $this->getAbout(),
            ]);
    }

    /**
     * @return \Kendo\Content\PosterInterface
     */
    public function getPoster()
    {
        return \App::find($this->getPosterType(), $this->getPosterId());
    }


    /**
     * @return \Kendo\Content\PosterInterface
     */
    public function getParent()
    {
        return \App::find($this->getParentType(), $this->getParentId());
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
    public function getId()
    {
        return $this->__get('id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('id', $value);
    }

    /**
     * @return null|string
     */
    public function getTypeId()
    {
        return $this->__get('type_id');
    }

    /**
     * @param $value
     */
    public function setTypeId($value)
    {
        $this->__set('type_id', $value);
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
    public function getAboutId()
    {
        return $this->__get('about_id');
    }

    /**
     * @param $value
     */
    public function setAboutId($value)
    {
        $this->__set('about_id', $value);
    }

    /**
     * @return null|string
     */
    public function getAboutType()
    {
        return $this->__get('about_type');
    }

    /**
     * @param $value
     */
    public function setAboutType($value)
    {
        $this->__set('about_type', $value);
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
    public function getRead()
    {
        return $this->__get('read');
    }

    /**
     * @param $value
     */
    public function setRead($value)
    {
        $this->__set('read', $value);
    }

    /**
     * @return null|string
     */
    public function getMitigated()
    {
        return $this->__get('mitigated');
    }

    /**
     * @param $value
     */
    public function setMitigated($value)
    {
        $this->__set('mitigated', $value);
    }

    /**
     * @return null|string
     */
    public function getParams()
    {
        return $this->__get('params');
    }

    /**
     * @param $value
     */
    public function setParams($value)
    {
        $this->__set('params', $value);
    }

    /**
     * @return null|string
     */
    public function getAtomType()
    {
        return $this->__get('atom_type');
    }

    /**
     * @param $value
     */
    public function setAtomType($value)
    {
        $this->__set('atom_type', $value);
    }

    /**
     * @return null|string
     */
    public function getAtomId()
    {
        return $this->__get('atom_id');
    }

    /**
     * @param $value
     */
    public function setAtomId($value)
    {
        $this->__set('atom_id', $value);
    }

    /**
     * @return \Platform\Notification\Model\NotificationTable
     */
    public function table()
    {
        return \App::table('platform_notification');
    }
    //END_TABLE_GENERATOR
}