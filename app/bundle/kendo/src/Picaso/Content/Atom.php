<?php
namespace Picaso\Content;

/**
 * Interface Atom
 *
 * @package Picaso\Content
 */
interface Atom
{
    /**
     * @return string
     */
    public function getType();


    /**
     * @return string
     */
    public function getId();
}