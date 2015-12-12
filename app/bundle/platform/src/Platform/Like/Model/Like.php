<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_like`
 */

namespace Platform\Like\Model;

/**
 */
use Kendo\Model;

/**
 * Class Like
 *
 * @package Like\Model
 */
class Like extends Model
{
    /**
     * Notify method
     *
     * onBeforeInsertLike
     * onBeforeDeleteLike
     * onAfterInsertLike
     * onAfterDeleteLike
     *
     * @var string
     */
    protected $_signalKey = 'Like';

    /**
     * @return \Kendo\Content\PosterInterface
     */
    public function getPoster()
    {
        return \App::find($this->getPosterType(), $this->getPosterId());
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
     * @return \Platform\Like\Model\LikeTable
     */
    public function table()
    {
        return \App::table('platform_like');
    }
    //END_TABLE_GENERATOR
}