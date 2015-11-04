<?php
namespace Picaso\Content;

/**
 * Class ImpHasPhoto
 *
 * @package Picaso\Content
 */
Trait ImpHasPhoto
{
    /**
     * @param string $maker
     *
     * @return string
     */
    public function getPhoto($maker)
    {
        if (!$this instanceof HasPhoto) return '';

        if ($this->getPhotoFileId() > 0) {
            if (null != ($src = \App::storage()
                    ->getUrlByOriginAndMaker($this->getPhotoFileId(), $maker))
            ) {
                return $src;
            }
        }

        return \App::assets()->getUrl('/static/nophoto/' . $this->getType() . '_' . $maker . '.jpg');
    }
}