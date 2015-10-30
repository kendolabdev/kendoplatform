<?php
namespace Picaso\Content;

/**
 * Interface CanTagPeople
 *
 * @package Picaso\Content
 */
interface CanTagPeople
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
    public function getPeopleCount();

    /**
     * @param int $value
     */
    public function setPeopleCount($value);

    /**
     * @return array
     */
    public function getPeople();

    /**
     * @param array $value
     */
    public function setPeople($value);
}