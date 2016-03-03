<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_help_post`
 */

namespace Platform\Help\Model;

/**
 */
use Kendo\Content\UniqueId;
use Kendo\Model;

/**
 * Class HelpPost
 *
 * @package Help\Model
 */
class HelpPost extends Model implements UniqueId
{
    /**
     * @return \Platform\Help\Model\HelpTopic
     */
    public function getTopic()
    {
        return \App::table('help.help_topic')->findById($this->getTopicId());
    }

    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->getPostTitle();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'help.help_post';
    }

    /**
     * @return array
     */
    public function getTokenArray()
    {
        return ['type' => $this->getType(), 'id' => $this->getId()];
    }

    /**
     * @return string
     */
    public function toHref()
    {
        $topic = $this->getTopic();

        return \App::routing()->getUrl('help', [
            'category' => $topic->getCategoryId(),
            'topic'    => $topic->getId(),
            'post'     => $this->getId(),
        ]);
    }

    /**
     * @return null|string
     */
    public function getContent()
    {
        return $this->getPostContent();
    }

    /**
     * @return null|string
     */
    public function getDescription()
    {
        return $this->getPostDescription();
    }

    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->__get('post_id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('post_id', $value);
    }

    /**
     * @return null|string
     */
    public function getPostId()
    {
        return $this->__get('post_id');
    }

    /**
     * @param $value
     */
    public function setPostId($value)
    {
        $this->__set('post_id', $value);
    }

    /**
     * @return null|string
     */
    public function getTopicId()
    {
        return $this->__get('topic_id');
    }

    /**
     * @param $value
     */
    public function setTopicId($value)
    {
        $this->__set('topic_id', $value);
    }

    /**
     * @return null|string
     */
    public function getPostActive()
    {
        return $this->__get('post_active');
    }

    /**
     * @param $value
     */
    public function setPostActive($value)
    {
        $this->__set('post_active', $value);
    }

    /**
     * @return null|string
     */
    public function getPostSortOrder()
    {
        return $this->__get('post_sort_order');
    }

    /**
     * @param $value
     */
    public function setPostSortOrder($value)
    {
        $this->__set('post_sort_order', $value);
    }

    /**
     * @return null|string
     */
    public function getPostTitle()
    {
        return $this->__get('post_title');
    }

    /**
     * @param $value
     */
    public function setPostTitle($value)
    {
        $this->__set('post_title', $value);
    }

    /**
     * @return null|string
     */
    public function getPostSlug()
    {
        return $this->__get('post_slug');
    }

    /**
     * @param $value
     */
    public function setPostSlug($value)
    {
        $this->__set('post_slug', $value);
    }

    /**
     * @return null|string
     */
    public function getPostContent()
    {
        return $this->__get('post_content');
    }

    /**
     * @param $value
     */
    public function setPostContent($value)
    {
        $this->__set('post_content', $value);
    }

    /**
     * @return null|string
     */
    public function getPostDescription()
    {
        return $this->__get('post_description');
    }

    /**
     * @param $value
     */
    public function setPostDescription($value)
    {
        $this->__set('post_description', $value);
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
    public function getUpdatedAt()
    {
        return $this->__get('updated_at');
    }

    /**
     * @param $value
     */
    public function setUpdatedAt($value)
    {
        $this->__set('updated_at', $value);
    }

    /**
     * @return \Platform\Help\Model\HelpPostTable
     */
    public function table()
    {
        return \App::table('platform_help_post');
    }
    //END_TABLE_GENERATOR
}