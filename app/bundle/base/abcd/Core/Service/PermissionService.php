<?php
namespace Core\Service;

use Kendo\Acl\Driver;

/**
 * Class PermissionService
 *
 * @package Core\Service
 */
class PermissionService implements Driver
{

    /**
     * @param int    $roleId
     * @param string $groupName
     *
     * @return array
     */
    public function loadForRoleAndGroup($roleId, $groupName)
    {
        $select = \App::table('core.acl_allow')
            ->select('allow')
            ->join(':acl_action', 'action', 'action.action_id=allow.action_id', null, null)
            ->where('action.group_name=?', (string)$groupName)
            ->where('allow.role_id=?', (int)$roleId);

        $response = [];

        foreach ($select->all() as $row) {
            $data = json_decode($row['value'], 1);
            $key = $row['group_name'] . '.' . $row['action_name'];
            $role = (int)$row['role_id'];

            // strict check
            if (empty($response[ $role ])) {
                $response[ $role ] = [];
            }

            $response[ $role ][ $key ] = @$data['val'];
        }

        return $response;
    }

    /**
     * @return array
     */
    public function loadAll()
    {
        // TODO: Implement loadAll() method.
    }

    /**
     * @param $roleId
     *
     * @return array
     */
    public function loadForRole($roleId)
    {
        // TODO: Implement loadForRole() method.
    }

    /**
     * @param  int   $roleId
     * @param  array $data
     *
     * @return mixed
     */
    public function saveForRole($roleId, $data)
    {
        // TODO: Implement saveForRole() method.
    }

    /**
     * @param string $module
     * @param string $group
     * @param array  $actions
     *
     * @throws AuthorizationException
     */
    public function addActionList($module, $group, $actions)
    {
        // TODO: Implement addActionList() method.
    }

    /**
     * @param array $groups
     * @param array $actions
     *
     * @return array
     */
    public function getActionList($groups, $actions)
    {
        // TODO: Implement getActionList() method.
    }


}