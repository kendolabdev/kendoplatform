<?php

namespace Kendo\Content;

/**
 * Interface Poster
 *
 * @package Kendo\Content
 */
interface PosterInterface extends ContentInterface
{
    /**
     * @return int
     */
    public function getPhotoFileId();

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
}
