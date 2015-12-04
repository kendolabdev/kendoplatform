<?php

namespace Picaso\Application;

/**
 * Class InstallHandler
 *
 * @package Picaso\Application
 */
class ModuleInstallHandler
{
    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @var array
     */
    protected $success = [];

    /**
     * @var array
     */
    protected $warnings = [];

    /**
     * @var array
     */
    protected $finalData;

    /**
     * @var string
     */
    protected $sourcePath = '';

    /**
     * @var string
     */
    protected $moduleName = '';

    /**
     * @return array
     */
    public function getModuleList()
    {
        return [$this->getModuleName()];
    }

    /**
     * @return string
     */
    public function getModuleName()
    {
        return $this->moduleName;
    }

    /**
     * @param string $moduleName
     */
    public function setModuleName($moduleName)
    {
        $this->moduleName = $moduleName;
    }


    /**
     * @return array
     */
    public function getFinalData()
    {
        return $this->finalData;
    }

    /**
     * @return string
     */
    public function getSourcePath()
    {
        return $this->sourcePath;
    }

    /**
     * @param string $sourcePath
     */
    public function setSourcePath($sourcePath)
    {
        $this->sourcePath = $sourcePath;
    }

    /**
     * @return array
     */
    public function getListTableSuffix()
    {
        if (null == $this->getModuleName())
            return [];

        return [$this->getModuleName()];
    }

    /**
     *
     */
    protected function beforeExport()
    {
        $this->finalData = [];
    }

    /**
     *
     */
    protected function doExport()
    {
        $this->exportTableStructural();
        $this->exportExtension();
        $this->exportTypes();
        $this->exportSetting();
        $this->exportPhrase();
        $this->exportAcl();
        $this->exportNavigation();
        $this->exportInvitation();
        $this->exportFeed();
        $this->exportNotification();
        $this->exportAttribute();
        $this->exportRelation();
        $this->exportLayout();
        $this->exportMail();
        $this->exportHook();

    }

    /**
     * @return string
     */
    public function getPackageFilePath()
    {
        return PICASO_MODULE_DIR . '/' . $this->getSourcePath() . '/Install/package.json';
    }

    /**
     * write final data to installer with/without data from now.
     */
    protected function afterExport()
    {

    }

    /**
     *
     */
    public function updatePackageFile()
    {
        $content = json_encode($this->finalData, JSON_PRETTY_PRINT);

        $file = $this->getPackageFilePath();

        file_put_contents($file, $content);
    }

    /**
     * Export data table
     */
    public function export()
    {

        $this->beforeExport();
        $this->doExport();
        $this->afterExport();
        $this->updatePackageFile();
    }

    /**
     * Import data
     */
    public function install()
    {
        $this->readPackageFile();
        $this->beforeInstall();
        $this->doInstall();
        $this->afterInstall();
    }

    /**
     *
     */
    public function readPackageFile()
    {
        $this->finalData = json_decode(file_get_contents($file = $this->getPackageFilePath()), true);
    }

    /**
     *
     */
    protected function beforeInstall()
    {

    }

    /**
     *
     */
    protected function doInstall()
    {
        $this->installTableStructural();
        $this->installExtension();
        $this->installTypes();
        $this->installSetting();
        $this->installPhrase();
        $this->installAcl();
        $this->installNavigation();
        $this->installInvitation();
        $this->installFeed();
        $this->installNotification();
        $this->installAttribute();
        $this->installRelation();
        $this->installLayout();
        $this->installMail();
        $this->installHook();
    }

    /**
     *
     */
    protected function exportHook()
    {
        $this->finalData['core_hook']
            = \App::coreService()->hook()
            ->getListHookByModuleName($this->getModuleList());
    }

    /**
     *
     */
    protected function installHook()
    {
        if (!empty($this->finalData['core_hook'])) {
            foreach ($this->finalData['core_hook'] as $data) {
                unset($data['id']);
                \App::table('core.core_hook')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     *
     */
    protected function exportMail()
    {
        $this->finalData['mail_template']
            = \App::mailService()
            ->getListTemplateByModuleName($this->getModuleList());
    }

    /**
     *
     */
    protected function installMail()
    {
        if (!empty($this->finalData['mail_template'])) {
            foreach ($this->finalData['mail_template'] as $data) {
                unset($data['template_id']);
                \App::table('mail.mail_template')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     *
     */
    protected function exportLayout()
    {
        $this->finalData['layout_support_block']
            = \App::layoutService()->getListSupportBlockByModuleName($this->getModuleList());

        $this->finalData['layout_page']
            = \App::layoutService()->getListPageByModuleName($this->getModuleList());

        $this->finalData['layout_data'] =
            \App::layoutService()->exportLayoutData($this->getModuleList());

    }

    /**
     *
     */
    protected function installLayout()
    {
        if (!empty($this->finalData['layout_support_block'])) {
            foreach ($this->finalData['layout_support_block'] as $data) {
                \App::table('layout.layout_support_block')
                    ->insertIgnore($data);
            }
        }

        if (!empty($this->finalData['layout_page'])) {
            foreach ($this->finalData['layout_page'] as $data) {
                unset($data['page_id']);
                \App::table('layout.layout_page')
                    ->insertIgnore($data);
            }
        }

        if (!empty($this->finalData['layout_data'])) {
            \App::layoutService()->importLayoutData($this->finalData['layout_data']);
        }
    }

    /**
     *
     */
    protected function afterInstall()
    {
        $this->finalData = [];
    }

    /**
     *
     */
    protected function exportRelation()
    {
        $this->finalData['relation_type']
            = \App::relationService()->getListRelationTypeByModuleName($this->getModuleList());
    }

    /**
     *
     */
    protected function installRelation()
    {
        if (!empty($this->finalData['relation_type'])) {
            foreach ($this->finalData['relation_type'] as $data) {
                unset($data['type_id']);
                \App::table('relation.relation_type')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     *
     */
    protected function exportFeed()
    {
        $this->finalData['feed_type']
            = \App::feedService()->getListTypeByModuleName($this->getModuleList());
    }

    /**
     *
     */
    protected function exportExtension()
    {
        $this->finalData['core_extension']
            = \App::coreService()->extension()
            ->getListExtensionByModuleName($this->getModuleList());
    }

    /**
     *
     */
    protected function installExtension()
    {
        if (!empty($this->finalData['core_extension'])) {
            foreach ($this->finalData['core_extension'] as $data) {
                \App::table('core.core_extension')
                    ->insertIgnore($data);

                \App::autoload()
                    ->addNamespace($data['namespace'], PICASO_MODULE_DIR . $data['path']);
            }
        }
    }

    /**
     *
     */
    protected function installFeed()
    {
        if (!empty($this->finalData['feed_type'])) {
            foreach ($this->finalData['feed_type'] as $data) {
                \App::table('feed.feed_type')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     *
     */
    protected function exportNotification()
    {
        $this->finalData['notification_type']
            = \App::notificationService()->getListTypeByModuleName($this->getModuleList());
    }

    /**
     *
     */
    protected function installNotification()
    {
        if (!empty($this->finalData['notification_type'])) {
            foreach ($this->finalData['notification_type'] as $data) {
                \App::table('notification.notification_type')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     *
     */
    protected function exportInvitation()
    {
        $this->finalData['invitation_type']
            = \App::invitationService()->getListTypeByModuleName($this->getModuleList());
    }


    /**
     *
     */
    protected function installInvitation()
    {
        if (!empty($this->finalData['invitation_type'])) {
            foreach ($this->finalData['invitation_type'] as $data) {
                \App::table('invitation.invitation_type')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     *
     */
    protected function exportTypes()
    {
        $this->finalData['core_type']
            = \App::coreService()->getListTypeByModuleName($this->getModuleList());
    }

    /**
     *
     */
    protected function installTypes()
    {
        /**
         * insert types
         */
        if (!empty($this->finalData['core_type'])) {
            foreach ($this->finalData['core_type'] as $data) {
                \App::table('core.core_type')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     *
     */
    protected function exportAttribute()
    {
        $this->finalData['attribute_plugin']
            = \App::catalogService()->getListPluginByModuleName($this->getModuleList());
    }

    /**
     *
     */
    protected function installAttribute()
    {
        // insert attribute plugins
        if (!empty($this->finalData['attribute_plugin'])) {
            foreach ($this->finalData['attribute_plugin'] as $data) {
                \App::table('attribute.attribute_plugin')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     *
     */
    protected function exportNavigation()
    {
        $this->finalData['navigation'] =
            \App::navigationService()->getListNavigationByModuleName($this->getModuleList());

        $this->finalData['navigation_item']
            = \App::navigationService()->getListItemByModuleName($this->getModuleList());
    }

    /**
     *
     */
    protected function installNavigation()
    {
        // insert attribute plugins
        if (!empty($this->finalData['navigation'])) {
            foreach ($this->finalData['navigation'] as $data) {
                \App::table('navigation')
                    ->insertIgnore($data);
            }
        }

        // insert attribute plugins
        if (!empty($this->finalData['navigation_item'])) {
            foreach ($this->finalData['navigation_item'] as $data) {
                \App::table('navigation.navigation_item')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     *
     */
    protected function exportAcl()
    {
        $this->finalData['acl_role']
            = \App::aclService()->getListRoleByModuleName($this->getModuleList());

        $this->finalData['acl_group']
            = \App::aclService()->getListGroupByModuleName($this->getModuleList());

        $this->finalData['acl_action']
            = \App::aclService()->getListActionByModuleName($this->getModuleList());

        $this->finalData['acl_allow_data']
            = \App::aclService()->exportAclAllowData($this->getModuleList());
    }

    /**
     *
     */
    protected function installAcl()
    {
        if (!empty($this->finalData['acl_role'])) {
            foreach ($this->finalData['acl_role'] as $data) {
                \App::table('acl.acl_role')
                    ->insertIgnore($data);
            }
        }

        if (!empty($this->finalData['acl_group'])) {
            foreach ($this->finalData['acl_group'] as $data) {
                \App::table('acl.acl_group')
                    ->insertIgnore($data);
            }
        }

        if (!empty($this->finalData['acl_action'])) {
            foreach ($this->finalData['acl_action'] as $data) {
                unset($data['action_id']);
                \App::table('acl.acl_action')
                    ->insertIgnore($data);
            }
        }

        if (!empty($this->finalData['acl_allow_data'])) {
            \App::aclService()->importAclAllowData($this->finalData['acl_allow_data']);
        }
    }

    /**
     *
     */
    protected function exportSetting()
    {
        $this->finalData['setting_action']
            = \App::settingService()->getActionListByModuleName($this->getModuleList());

        $this->finalData['setting_value']
            = \App::settingService()->getSettingListByModuleName($this->getModuleList());

    }


    /**
     *
     */
    protected function installSetting()
    {

        if (!empty($this->finalData['setting_action'])) {
            foreach ($this->finalData['setting_action'] as $data) {
                unset($data['action_id']);
                \App::table('setting.setting_action')
                    ->insertIgnore($data);
            }
        }

        if (!empty($this->finalData['setting_value'])) {
            \App::settingService()
                ->save($this->finalData['setting_value']);
        }
    }

    /**
     *
     */
    protected function exportPhrase()
    {
        $this->finalData['phrase']
            = \App::phraseService()->getListPhraseByModuleName($this->getModuleList());
    }

    /**
     *
     */
    protected function installPhrase()
    {
        if (!empty($this->finalData['phrase'])) {
            foreach ($this->finalData['phrase'] as $data) {

                unset($data['phrase_id']);

                \App::table('phrase')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     * @return array
     */
    protected function exportTableStructural()
    {
        $db = \App::db();

        $listTable = $db->getMaster()
            ->tables();

        $tables = [];
        $prefix = $db->getPrefix();

        $listFilterSuffix = $this->getListTableSuffix();

        if (!$listFilterSuffix)
            return [];


        foreach ($listTable as $tableName) {

            $suffixName = substr($tableName, strlen($prefix));

            $match = false;

            foreach ($listFilterSuffix as $filterSuffix) {
                if (strpos($suffixName, $filterSuffix) !== 0) continue;
                $match = true;
            }
            if (!$match) continue;


            $correctName = ':table_prefix_' . $suffixName;

            $createSql = \App::db()
                ->getMaster()
                ->getCreateTableSql($tableName);

            $createSql = str_replace($tableName, $correctName, $createSql);

            $createSql = preg_replace("# AUTO_INCREMENT=\d+#", '', $createSql);

            // crop prefix from database.
            $tables[ $suffixName ] = $createSql;
        }

        $this->finalData['tables'] = $tables;
    }

    /**
     *
     */
    protected function installTableStructural()
    {

        $tables = $this->finalData['tables'];

        if (empty($tables))
            return;

        $db = \App::db();
        $prefix = $db->getPrefix();
        $master = $db->getMaster();

        $listExistsTable = $master->tables();

        foreach ($tables as $name => $createSql) {

            // check condition clear table if exists
            // fresh installation only
            if (array_search($prefix . $name, $listExistsTable) !== false) continue;

            $createSql = str_replace(':table_prefix_', $prefix, $createSql);

            $master->exec($createSql);
        }
    }

    /**
     * @return array
     */
    protected function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    protected function setErrors($errors)
    {
        $this->errors = $errors;
    }

    /**
     * @return array
     */
    protected function getSuccess()
    {
        return $this->success;
    }

    /**
     * @param array $success
     */
    protected function setSuccess($success)
    {
        $this->success = $success;
    }

    /**
     * @return array
     */
    protected function getWarnings()
    {
        return $this->warnings;
    }

    /**
     * @param array $warnings
     */
    protected function setWarnings($warnings)
    {
        $this->warnings = $warnings;
    }

    /**
     * @param $msg
     */
    protected function addWarning($msg)
    {
        $this->warnings[] = $msg;
    }

    /**
     * @param $msg
     */
    protected function addError($msg)
    {
        $this->errors[] = $msg;
    }

    /**
     * @param $msg
     */
    protected function addSuccess($msg)
    {
        $this->success[] = $msg;
    }

    /**
     * @return bool
     */
    public function checkDependency()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function upgrade()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function disable()
    {
        return true;

    }

    /**
     * @return bool
     */
    public function enable()
    {
        return true;
    }
}