<?php
namespace Picaso\Content;

/**
 * Trait ImpCanTagPlace
 *
 * @package Picaso\Content
 */
Trait ImpCanTagPlace
{
    /**
     * Find associate place
     *
     * @return \Place\Model\Place
     */
    public function getPlace()
    {

        if (null != $this->getPlaceId()) {
            return \App::find($this->getPlaceType(), $this->getPlaceId());
        }

        return null;
    }

    /**
     * Require place params lat, lng, title, address
     *
     * @param mixed $place
     */
    public function setPlace($place)
    {
        if (!$this instanceof CanTagPlace) ;

        if (!$place instanceof Content) {
            $place = \App::service('place')->tryPlace($place);
        }

        if ($place instanceof Content) {
            $this->setPlaceId($place->getId());
            $this->setPlaceType($place->getType());
        }
    }
}
