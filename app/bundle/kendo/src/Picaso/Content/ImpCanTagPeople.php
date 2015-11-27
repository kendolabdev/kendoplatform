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

        return \App::tagService()->loadPeople($this, $limit);
    }

    /**
     * @param $people
     */
    public function setPeople($people)
    {
        if ($this instanceof CanTagPeople) {
            $total = \App::tagService()->tagPeople($this, $people);
            $this->setPeopleCount($total);
        }
    }
}