<?php

namespace Kendo\Acl;

/**
 * Interface AclLoaderInterface
 *
 * @package Kendo\Acl
 */
interface AclLoaderInterface
{

    /**
     * @param $roleId
     *
     * @return array
     */
    public function loadForRole($roleId);

    /**
     * @param  int   $roleId
     * @param  array $data
     *
     * @return mixed
     */
    public function saveForRole($roleId, $data);

    /**
     * @param string $module
     * @param string $group
     * @param array  $actions
     */
    public function addActionList($module, $group, $actions);

    /**
     * @param array $groups
     * @param array $actions
     *
     * @return array
     */
    public function getActionList($groups, $actions);

    /**
     * @param $roleId
     * @param $groups
     *
     * @return array
     */
    public function loadForEdit($roleId, $groups);
}