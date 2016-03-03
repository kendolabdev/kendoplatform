<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_feed_feed`
 */

namespace Platform\Feed\Model;

/**
 */
use Kendo\Content\TraitBaseContent;
use Kendo\Content\UniqueId;
use Kendo\Model;

/**
 * Class Feed
 *
 * @package Feed\Model
 */
class Feed extends Model implements UniqueId
{
    use TraitBaseContent;

    /**
     * @return string
     */
    public function getType()
    {
        return 'feed';
    }

    /**
     * @param $privacyType
     * @param $privacyValue
     */
    public function updatePrivacy($privacyType, $privacyValue)
    {
        $this->setPrivacyType($privacyType);
        $this->setPrivacyValue($privacyValue);

        $this->save();

        \App::table('platform_feed_stream')
            ->update(['privacy_type' => $privacyType, 'privacy_value' => $privacyValue])
            ->where('feed_id=?', $this->getId())
            ->execute();

    }

    /**
     * @return bool
     */
    public function isStatusUpdate()
    {
        return $this->getAboutType() == 'platform_feed_status';
    }

    /**
     * @param string $name
     * @param mixed  $defaultValue
     *
     * @return mixed
     */
    public function getParam($name, $defaultValue = null)
    {
        $params = json_decode($this->getParamsText(), 1);

        if (isset($params[ $name ])) {
            return $params[ $name ];
        }

        return $defaultValue;
    }

    /**
     * @return string
     */
    public function getHeadline()
    {
        $msgId = 'feed_headline.' . $this->getFeedType();

        return \App::twig()
            ->renderHeadline($msgId, ['feed'   => $this,
                                      'poster' => $this->getPoster(),
                                      'parent' => $this->getParent(),
            ]);
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function toHref($params = [])
    {
        $params['id'] = $this->getId();

        return \App::routing()->getUrl('feed_view', $params);
    }

    /**
     * @param bool $willSilent
     * @param bool $willDelete
     *
     * @return bool
     */
    public function validate($willSilent = true, $willDelete = false)
    {
        $parent = \App::find($this->getParentType(), $this->getParentId());
        $poster = \App::find($this->getPosterType(), $this->getPosterId());
        $about = \App::find($this->getAboutType(), $this->getAboutId());

        if (empty($parent) || empty($poster) || empty($about)) {
            if ($willDelete) {
                $this->delete();
            }
            if ($willSilent) {
                return false;
            } else {
                throw new \InvalidArgumentException("Invalid feed content");
            }
        }

        return true;
    }


    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->__get('feed_id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('feed_id', $value);
    }

    /**
     * @return null|string
     */
    public function getFeedId()
    {
        return $this->__get('feed_id');
    }

    /**
     * @param $value
     */
    public function setFeedId($value)
    {
        $this->__set('feed_id', $value);
    }

    /**
     * @return null|string
     */
    public function getFeedType()
    {
        return $this->__get('feed_type');
    }

    /**
     * @param $value
     */
    public function setFeedType($value)
    {
        $this->__set('feed_type', $value);
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
    public function getParamsText()
    {
        return $this->__get('params_text');
    }

    /**
     * @param $value
     */
    public function setParamsText($value)
    {
        $this->__set('params_text', $value);
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
     * @return \Platform\Feed\Model\FeedTable
     */
    public function table()
    {
        return \App::table('platform_feed');
    }
    //END_TABLE_GENERATOR
}