<?php
namespace Platform\Acl\Service;

use Platform\Acl\Model\AclAction;
use Platform\Acl\Model\AclGroup;
use Platform\Acl\Model\AclRole;
use Platform\Core\Model\CoreType;
use Kendo\Acl\AclLoaderInterface;
use Kendo\Acl\AuthorizationRestrictException;
use Kendo\Acl\PrivacyRestrictException;
use Kendo\Content\ContentInterface;
use Kendo\Content\PosterInterface;
use Kendo\Db\SqlSelect;

/**
 * Class DbDriver
 *
 * @package Kendo
 */
class AclService implements AclLoaderInterface
{

    /**
     * @var AclLoaderInterface
     */
    protected $loader;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var bool
     */
    protected $debug = false;

    /**
     * Reset acl load status but default user id.
     * WARNING: Call this method after changed acl configuration.
     *
     */
    public function reset()
    {
        $this->data = [];
        $this->loader = null;
    }


    /**
     * @param string $id
     *
     * @return \Platform\Acl\Model\AclGroup
     */
    public function findGroupById($id)
    {
        return \App::table('platform_acl_group')
            ->findById($id);
    }

    /**
     * @param string $id
     *
     * @return \Platform\Acl\Model\AclRole
     */
    public function findRoleById($id)
    {
        return \App::table('platform_acl_role')
            ->findById((int)$id);
    }

    /**
     * @return SqlSelect
     */
    protected function getSelect()
    {

        return \App::table('platform_acl_allow')
            ->select('allow')
            ->join(':platform_acl_action', 'action', 'action.action_id=allow.action_id', null, null)
            ->columns('group_name, action_name,allow.*');
    }

    /**
     * @param int   $roleId
     * @param array $groups
     *
     * @return array
     */
    public function loadForEdit($roleId, $groups)
    {

        return $this->loadForRole($roleId);
    }

    /**
     * @param int $roleId
     *
     * @return array
     */
    public function loadForRole($roleId)
    {
        return \App::cacheService()
            ->get(['acl', 'loadForRole', $roleId], 0, function () use ($roleId) {
                return $this->_loadForRole($roleId);
            });
    }


    /**
     * @param string $roleId
     *
     * @return array
     */
    protected function getFlatValForRoleId($roleId)
    {
        return \App::cacheService()
            ->get(['acl', '_getMapForRoleId', $roleId], 0,
                function () use ($roleId) {
                    $response = [];
                    $select = $this->getSelect()
                        ->where('allow.role_id =?', $roleId);

                    foreach ($select->toAssocs() as $row) {
                        $data = json_decode($row['value'], 1);
                        $key = $row['group_name'] . '__' . $row['action_name'];
                        $response[ $key ] = @$data['val'];
                    }

                    return $response;
                });
    }

    /**
     * @return int
     */
    protected function countAllAction()
    {
        return \App::cacheService()
            ->get(['acl', 'countAllAction'], 0, function () {
                return \App::table('platform_acl_action')
                    ->select()
                    ->columns('group_name, action_name')
                    ->count();
            });
    }


    /**
     * Support multiple level role configuration.
     *
     * @param int $roleId
     *
     * @return array
     */
    public function _loadForRole($roleId)
    {
        $roleItem = \App::table('platform_acl_role')
            ->findById($roleId);

        if (!$roleItem instanceof AclRole) {
            throw new \InvalidArgumentException("Role $roleId is not valid.");
        }

        $listRoleId = $roleItem->getListAncestorId();
        /**
         * You may ned to load if not admin & super
         * if(!$roleItem->isAdmin() && !$roleItem->isSuper()){}
         *
         */

        $response = [];

        $total = $this->countAllAction();

        foreach ($listRoleId as $id) {
            $response = array_merge($this->getFlatValForRoleId($id), $response);

            if (count($response) == $total) break;

        }

        /**
         * override these value for security check.
         */
        $response['is_super'] = $roleItem->isSuper();
        $response['is_admin'] = $roleItem->isAdmin();
        $response['is_moderator'] = $roleItem->isModerator();
        $response['is_member'] = $roleItem->isMember();
        $response['is_guest'] = $roleItem->isGuest();

        return $response;
    }

    /**
     * @param string $module
     * @param string $group
     * @param array  $actions
     *
     */
    public function addActionList($module, $group, $actions)
    {
        $table = \App::table('platform_acl_action');

        if (empty($module))
            throw new \InvalidArgumentException("Module name is required");


        if (empty($group))
            throw new \InvalidArgumentException("Group name is required");


        foreach ($actions as $action) {
            if (empty($action)) {
                continue;
            }

            $row = $table->select()
                ->where('group_name = ?', (string)$group)
                ->where('action_name=?', (string)$action)
                ->where('module_name=?', (string)$module)
                ->one();

            if (!$row) {
                $row = $table->fetchNew([
                    'module_name' => $module,
                    'group_name'  => $group,
                    'action_name' => $action,
                    'comment'     => '',
                ]);
            }
            $row->save();
        }
    }

    /**
     * @param  int   $roleId
     * @param  array $postData
     *
     * @return mixed
     */
    public function saveForRole($roleId, $postData)
    {
        $data = [];

        foreach ($postData as $name => $value) {
            if (false === ($pos = strpos($name, '__'))) continue;
            $group = substr($name, 0, $pos);
            $key = substr($name, $pos + 2);

            if (empty($data[ $group ]))
                $data[ $group ] = [];

            $data[ $group ][ $key ] = $value;
        }

        $groups = array_keys($data);

        if (empty($groups)) {
            return;
        }

        $actionList = $this->getActionList($groups, null);

        if (empty($actionList)) {
            return;
        }

        $insertData = [];

        foreach ($data as $group => $actions) {
            foreach ($actions as $action => $value) {
                $key = sprintf('%s__%s', $group, $action);
                if (isset($actionList[ $key ])) {
                    $insertData[ $actionList[ $key ] ] = json_encode(['val' => $value]);
                }
            }
        }

        $allowTable = \App::table('platform_acl_allow');

        foreach ($insertData as $actionId => $actionValue) {
            $row = $allowTable->select()
                ->where('role_id=?', $roleId)
                ->where('action_id=?', $actionId)
                ->one();

            if (!$row) {
                $row = $allowTable->fetchNew([
                    'action_id' => $actionId,
                    'role_id'   => $roleId,
                ]);
            }

            $row->__set('value', $actionValue);

            $row->save();
        }


        $this->reset();

        /**
         * forget cached value
         */
        \App::cacheService()
            ->flush();
    }

    /**
     * @param array $groups
     * @param array $actions
     *
     * @return array
     */
    public function getActionList($groups, $actions)
    {
        $response = [];

        $select = \App::table('platform_acl_action')->select();

        if (!empty($groups)) {
            $select->where('group_name in ?', $groups);
        }

        if (!empty($actions)) {
            $select->where('action_name in ?', $actions);
        }

        foreach ($select->all() as $row) {
            if (!$row instanceof AclAction) continue;

            $key = sprintf('%s__%s', $row->getGroupName(), $row->getActionName());
            $response[ $key ] = $row->getId();
        }

        return $response;
    }

    /**
     * @param string $type
     *
     * @return array
     */
    public function getRoleOptions($type = null)
    {
        return \App::cacheService()
            ->get(['acl.role', 'getRoleOptions', $type], 0, function () use ($type) {
                return $this->_getRoleOptions($type);
            });
    }

    /**
     * @param string $type
     *
     * @return array
     */
    public function _getRoleOptions($type = null)
    {
        $select = \App::table('platform_acl_role')
            ->select();

        if ($type)
            $select->where('role_type=?', (string)$type);

        $options = [];

        foreach ($select->all() as $role) {
            if (!$role instanceof AclRole) continue;

            $options[] = [
                'value' => $role->getId(),
                'label' => $role->getTitle(),
            ];
        }

        return $options;
    }

    /**
     * @return array
     */
    public function getGroupOptions()
    {
        return \App::cacheService()
            ->get(['acl.acl', 'getGroupOptions', null], 0, function () {
                return $this->getGroupOptionsFromRepository();
            });
    }


    /**
     * @return array
     */
    public function getGroupOptionsFromRepository()
    {
        $options = [];

        $items = \App::table('platform_acl_group')
            ->select()
            ->where('module_name IN ?', \App::extensions()->getActiveModuleNames())
            ->order('module_name', -1)
            ->order('sort_order', 1)
            ->all();

        foreach ($items as $item) {
            if (!$item instanceof AclGroup) continue;
            $options[] = [
                'value' => $item->getId(),
                'label' => $item->getGroupTitle()
            ];
        }

        return $options;
    }

    /**
     * @return array
     */
    public function getRoleTypeOptions()
    {
        return \App::cacheService()
            ->get(['acl.acl', 'getRoleTypeOptions', null], 0, function () {
                return $this->getRoleTypeOptionsFromRepository();
            });
    }

    /**
     * @return array
     */
    public function getRoleTypeOptionsFromRepository()
    {
        $options = [];

        $posters = \App::table('platform_core_type')
            ->select()
            ->where('is_poster=?', 1)
            ->where('module_name IN ?', \App::extensions()->getActiveModuleNames())
            ->all();

        foreach ($posters as $poster) {
            if (!$poster instanceof CoreType) continue;

            $options[] = [
                'value' => $poster->getId(),
                'label' => $poster->getName(),
            ];

        }

        return $options;
    }


    /**
     * @param int $roleId
     *
     * @return array
     */
    public function getData($roleId)
    {
        if (!isset($this->data[ $roleId ])) {
            $this->data[ $roleId ] = $this->getLoader()->loadForRole($roleId);
        }

        return $this->data;
    }

    /**
     * @param int   $role
     * @param array $data
     */
    public function setData($role, $data)
    {
        $this->data[ $role ] = $data;
    }

    /**
     * @return AclLoaderInterface
     */
    public function getLoader()
    {
        if (null == $this->loader) {
            $this->loader = \App::service(\App::registryService()->get('AclLoader', 'platform_acl'));
        }

        return $this->loader;
    }

    /**
     * @param AclLoaderInterface $loader
     */
    public function setLoader(AclLoaderInterface $loader)
    {
        $this->loader = $loader;
    }

    /**
     * Check allow action
     *
     * @param string $action
     * @param bool   $defaultValue
     *
     * @return mixed
     */
    public function allow($action, $defaultValue = true)
    {
        $roleId = \App::authService()->getRoleId();

        if (!isset($this->data[ $roleId ])) {
            $this->data[ $roleId ] = $this->getLoader()->loadForRole($roleId);
        }

        if (!isset($this->data[ $roleId ][ $action ])) {
            return $defaultValue;
        }

        return $this->data[ $roleId ][ $action ];
    }

    /**
     * @param PosterInterface $parent
     * @param                 $action
     * @param bool|true       $defaultValue
     *
     * @return bool
     */
    public function authorizeFor(PosterInterface $parent = null, $action, $defaultValue = false)
    {
        if (!$this->_authorize($roleId = null != $parent ? $parent->getRoleId() : KENDO_GUEST_ROLE_ID, $action, $defaultValue))
            return false;

        return true;
    }

    /**
     * Authorize for current viewer
     *
     * @param string    $action
     * @param bool|true $defaultValue
     *
     * @return false|true
     */
    public function authorize($action, $defaultValue = false)
    {
        return $this->_authorize(\App::authService()->getRoleId(), $action, $defaultValue);
    }

    /**
     * Check pass authorization ?
     *
     * @param int    $roleId
     * @param string $action
     * @param bool   $defaultValue default is true
     *
     *
     * @return true|false
     */
    private function _authorize($roleId, $action, $defaultValue = false)
    {


        if (!isset($this->data[ $roleId ])) {
            $this->data[ $roleId ] = $this->getLoader()->loadForRole($roleId);
        }

        if ($this->data[ $roleId ]['is_super']) {
            if ($action == 'is_guest') {
                return false;
            }

            return true;
        }

        if ($this->data[ $roleId ]['is_admin']) {
            return $action != 'is_super' && $action != 'is_guest';
        }

        if (!isset($this->data[ $roleId ][ $action ])) {
            return $defaultValue;
        }

//        var_dump($this->data[ $roleId ]);
        return $this->data[ $roleId ][ $action ] == "1";
    }

    /**
     * Check privacy control
     *
     * @param ContentInterface $content
     * @param string           $action etc: activity.comment, blog.view, activity.like, activity.follow
     *
     * @return bool
     */
    public function check(ContentInterface $content, $action)
    {


        $viewerId = \App::authService()->getId();
        $parentId = $content->getParentId();
        $isRegistered = $viewerId > 0;

        list($type, $value) = $content->getPrivacy($action);

        if ($this->debug)
            echo sprintf('[%s,%s,%s]', $action, $type, $value);

        if (!$isRegistered) {
            return $type == RELATION_TYPE_ANYONE;
        }

        /**
         * always
         */
        if (in_array($type, [RELATION_TYPE_ANYONE, RELATION_TYPE_REGISTERED])) {
            return true;
        }

        /**
         * Check match user id
         */
        if ($content->viewerIsPoster()) {
            return true;
        }

        /**
         * load relation between theme.
         */
        $list = \App::relationService()->getListRelationIdBetween($parentId, $viewerId);

        /**
         * check membership of viewer & content
         */
        if (!empty($list[ $value ]))
            return true;

        /**
         * check membership member of members. it's hard to check theme.
         */

        if (RELATION_TYPE_MEMBER_OF_MEMBER == $type) {
            return \App::relationService()->isMemberOfMember($parentId, $viewerId);
        }

        return false;
    }

    /**
     * @param ContentInterface|PosterInterface $content
     * @param string                           $action
     * @param bool                             $required
     *
     * @return bool
     */
    public function pass($content, $action, $required = false)
    {
        if (!$this->authorize($action)) {
            if ($required) {
                throw new AuthorizationRestrictException();
            }

            return false;
        }


        if (false !== ($pos = strrpos($action, '.'))) {
            $action = substr($action, $pos + 1);
        }

        if (!$this->check($content, $action)) {
            if ($required) {
                throw new PrivacyRestrictException();
            }

            return false;
        }

        return true;
    }

    /**
     * @param string $action
     * @param bool   $defaultValue = true
     *
     * @return true
     */
    public function required($action, $defaultValue = false)
    {
        if (!$this->authorize($action, $defaultValue)) {
            throw new AuthorizationRestrictException();
        }

        return true;
    }
}