<?php
namespace Picaso\Content;

/**
 * Class ImpCanTagPeople
 *
 * @package Picaso\Content
 */
Trait ImpCanTagPeople
{
    /**
     * @param int $limit
     *
     * @return array
     */
    public function getPeople($limit = null)
    {
        if (!$this instanceof CanTagPeople) ;

        return \App::tag()->loadPeople($this, $limit);
    }

    /**
     * @param $people
     */
    public function setPeople($people)
    {
        if ($this instanceof CanTagPeople) {
            $total = \App::tag()->tagPeople($this, $people);
            $this->setPeopleCount($total);
        }
    }
}