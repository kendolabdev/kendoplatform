<?php
namespace Picaso\Content;

use Feed\ViewHelper\LinkComment;
use Feed\ViewHelper\LinkLike;
use Feed\ViewHelper\LinkShare;

/**
 * Trait ImpBaseContent
 *
 * @package Picaso\Content
 */
Trait ImpBaseContent
{
    public function __toString()
    {
        return strtr('<a href=":href">:title</a>', [':href' => $this->toHref(), ':title' => $this->getTitle()]);
    }

    /**
     * @return string
     */
    public function toToken()
    {
        return sprintf('%s@%s', $this->getId(), $this->getType());
    }

    /**
     * @return Poster
     */
    public function getPoster()
    {
        return \App::find($this->getPosterType(), $this->getPosterId());
    }

    /**
     * @return Poster
     */
    public function getParent()
    {
        return \App::find($this->getParentType(), $this->getParentId());
    }

    /**
     * @return \User\Model\User
     */
    public function getUser()
    {
        return \App::find('user', $this->getUserId());
    }


    /**
     * @return bool
     */
    public function viewerIsPoster()
    {
        if (!\App::authService()->logged())
            return false;

        return (bool)array_intersect([\App::authService()->getId(), \App::authService()->getUserId()],
            [$this->getId(), $this->getPosterId(), $this->getUserId()]);
    }

    /**
     * @return bool
     */
    public function viewerIsParent()
    {
        if (!\App::authService()->logged())
            return false;

        return (bool)array_intersect([\App::authService()->getId(), \App::authService()->getUserId()],
            [$this->getId(), $this->getParentId(), $this->getParentUserId()]);
    }

    /**
     * @return bool
     */
    public function viewerIsPosterOrParent()
    {
        if (!\App::authService()->logged())
            return false;

        return (bool)array_intersect([\App::authService()->getId(), \App::authService()->getUserId()],
            [$this->getId(), $this->getparentId(), $this->getParentUserId(), $this->getUserId(), $this->getPosterId()]);
    }

    /**
     * @return array
     */
    public function toTokenArray()
    {
        return [
            'type' => $this->getType(),
            'id'   => $this->getId()
        ];
    }

    /**
     * @return string
     */
    public function toTokenJson()
    {
        return json_encode([
            'type' => $this->getType(),
            'id'   => $this->getId()
        ]);
    }

    /**
     * @return Content
     */
    public function getAbout()
    {
        return \App::find($this->getAboutType(), $this->getAboutId());
    }

    /**
     * @return string
     */
    public function lnLike()
    {
        return (new LinkLike())->__invoke($this);
    }

    /**
     * @return string
     */
    public function lnComment()
    {
        return (new LinkComment())->__invoke($this);
    }

    /**
     * @return string
     */
    public function lnShare()
    {
        return (new LinkShare())->__invoke($this);
    }
}