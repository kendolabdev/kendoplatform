<?php

namespace Picaso\Content;

/**
 * Interface Poster
 *
 * @package Picaso\Content
 */
interface Poster
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getType();

    /**
     * @return int
     */
    public function getUserId();

    /**
     * @return int
     */
    public function getPhotoFileId();

    /**
     * @return int
     */
    public function getParentUserId();

    /**
     * @return string
     */
    public function getProfileName();

    /**
     * @return string
     */
    public function getModuleName();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param array $params
     *
     * @return string
     */
    public function toHref($params = []);

    /**
     * @return string
     */
    public function toToken();

    /**
     * @return string
     */
    public function btnMemberCount();

    /**
     * @return string
     */
    public function btnMembership();

    /**
     * @return int
     */
    public function getRoleId();

    /**
     * @param string    $action
     * @param bool|true $value
     *
     * @return bool
     */
    public function authorize($action, $value = true);

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
}
