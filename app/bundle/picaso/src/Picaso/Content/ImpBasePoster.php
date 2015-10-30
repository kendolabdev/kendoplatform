<?php
namespace Picaso\Content;

/**
 * Class ImpBasePoster
 *
 * @package Picaso\Content
 */
Trait ImpBasePoster
{

    /**
     * @param string    $action
     * @param bool|true $defaultValue
     *
     * @return bool
     */
    public function authorize($action, $defaultValue = true)
    {
        return \App::acl()->authorizeFor($this, $action, $defaultValue);
    }
}