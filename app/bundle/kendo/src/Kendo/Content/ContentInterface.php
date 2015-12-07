<?php

namespace Kendo\Content;

/**
 * Interface Content
 *
 * @package Kendo\Content
 */
interface ContentInterface extends AtomInterface, AttachableInterface
{

    /**
     * @return int
     */
    public function getPhotoFileId();

    /**
     * @param string $value
     */
    public function setPhotoFileId($value);

    /**
     * @param string $maker
     *
     * @return string
     */
    public function getPhoto($maker);

    /**
     * @return int
     */
    public function getUserId();

    /**
     * @return int
     */
    public function getPosterId();

    /**
     * @return mixed
     */
    public function getPosterType();

    /**
     * @return int
     */
    public function getParentId();

    /**
     * @return string
     */
    public function getParentUserId();

    /**
     * @return string
     */
    public function getParentType();

    /**
     * @param array $params
     *
     * @return string
     */
    public function toHref($params = []);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return string
     */
    public function toToken();

    /**
     * @return PosterInterface
     */
    public function getPoster();

    /**
     * @return bool
     */
    public function viewerIsPoster();

    /**
     * @return bool
     */
    public function viewerIsParent();

    /**
     * @return bool
     */
    public function viewerIsPosterOrParent();

    /**
     * @return int
     */
    public function getShareCount();

    /**
     * @param int $value
     */
    public function setShareCount($value);

    /**
     * @param string $value
     */
    public function setStory($value);

    /**
     * @return string
     */
    public function getStory();

    /**
     * @return int
     */
    public function getPeopleCount();

    /**
     * @param int $value
     */
    public function setPeopleCount($value);

    /**
     * @return array
     */
    public function getPeople();

    /**
     * @param array $value
     */
    public function setPeople($value);

    /**
     * @return int
     */
    public function getPlaceId();

    /**
     * @return string
     */
    public function getPlaceType();

    /**
     * @param string $value
     */
    public function setPlaceType($value);

    /**
     * @param int $value
     */
    public function setPlaceId($value);

    /**
     * @return ContentInterface
     */
    public function getPlace();

    /**
     * @param $value
     */
    public function setPlace($value);

    /**
     * @param $name
     *
     * @return array
     */
    public function getPrivacy($name);

    /**
     * @return int
     */
    public function getPrivacyType();

    /**
     * @return int
     */
    public function getPrivacyValue();

    /**
     * @param string $action
     * @param string $type
     * @param string $value
     *
     * @return bool
     */
    public function updatePrivacy($action, $type, $value);
}
