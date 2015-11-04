<?php
namespace Picaso\Content;

/**
 * Interface ProfileServiceInterface
 *
 * @package Picaso\Content
 */
interface ProfileServiceInterface
{

    /**
     * @param Content $object
     *
     * @return array [key, value]
     */
    public function loadProfileValue(Content $object);

    /**
     * @param Content $object
     * @param         $data
     */
    public function saveProfileValue(Content $object, $data);
}