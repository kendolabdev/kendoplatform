<?php
namespace Kendo\Content;

/**
 * Class ImpBasePoster
 *
 * @package Kendo\Content
 */
Trait TraitBasePoster
{

    /**
     * @param string    $action
     * @param bool|true $defaultValue
     *
     * @return bool
     */
    public function authorize($action, $defaultValue = true)
    {
        return \App::aclService()->authorizeFor($this, $action, $defaultValue);
    }

    /**
     * @return mixed
     */
    public function getCover()
    {
        return $this->getCoverService()->getCover($this);
    }

    /**
     * @return \Platform\Photo\Service\PhotoService
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