<?php

namespace Picaso\Content;

/**
 * Interface Content
 *
 * @package Picaso\Content
 */
interface Content
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
     * @return Poster
     */
    public function getPoster();

    /**
     * @return Poster
     */
    public function getParent();

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
