<?php
namespace Picaso\Content;

/**
 * Interface HasPrivacy
 *
 * @package Picaso\Content
 */
interface HasPrivacy
{

    /**
     * @param $name
     *
     * @return array
     */
    public function getPrivacy($name);

    /**
     * @return int
     */
    public function getPrivacyType();

    /**
     * @return int
     */
    public function getPrivacyValue();

    /**
     * @param string $action
     * @param string $type
     * @param string $value
     *
     * @return bool
     */
    public function updatePrivacy($action, $type, $value);
}