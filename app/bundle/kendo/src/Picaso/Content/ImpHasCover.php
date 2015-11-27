<?php
namespace Picaso\Content;

/**
 * Class ImpHasCover
 *
 * @package Picaso\Content
 */
Trait ImpHasCover
{
    /**
     * @return mixed
     */
    public function getCover()
    {
        return $this->getCoverService()->getCover($this);
    }

    /**
     * @return \Photo\Service\PhotoService
     */
    public function getCoverService()
    {
        return \App::photoService();
    }

    /**
     * @param $photo
     * @param $position
     */
    public function setCover($photo, $position)
    {
        $this->getCoverService()->setCover($this, $photo, $position);
    }
}