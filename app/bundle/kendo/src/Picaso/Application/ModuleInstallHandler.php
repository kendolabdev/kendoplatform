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
        $content = json_encode($this->finalData);

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
    public function import()
    {
        $this->readPackageFile();

        $this->beforeImport();
        $this->doImport();
        $this->afterImport();
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
    protected function beforeImport()
    {

    }

    /**
     *
     */
    protected function doImport()
    {
        $this->importTableStructural();
        $this->importExtension();
        $this->importTypes();
        $this->importSetting();
        $this->importPhrase();
        $this->importAcl();
        $this->importNavigation();
        $this->importInvitation();
        $this->importFeed();
        $this->importNotification();
        $this->importAttribute();
        $this->importRelation();
        $this->importLayout();
        $this->importMail();
        $this->importHook();
    }

    /**
     *
     */
    public function exportHook()
    {
        $this->finalData['core_hook']
            = \App::core()->hook()
            ->getListHookByModuleName($this->getModuleList());
    }

    /**
     *
     */
    public function importHook()
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
    public function exportMail()
    {
        $this->finalData['mail_template']
            = \App::mail()->getListTemplateByModuleName($this->getModuleList());
    }

    /**
     *
     */
    public function importMail()
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
    public function exportLayout()
    {
        $this->finalData['layout_support_block']
            = \App::layout()->getListSupportBlockByModuleName($this->getModuleList());

        $this->finalData['layout_page']
            = \App::layout()->getListPageByModuleName($this->getModuleList());

        $this->finalData['layout_data'] =
            \App::layout()->exportLayoutData($this->getModuleList());

    }

    /**
     *
     */
    public function importLayout()
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
            \App::layout()->importLayoutData($this->finalData['layout_data']);
        }
    }

    /**
     *
     */
    protected function afterImport()
    {
        $this->finalData = [];
    }

    /**
     *
     */
    public function exportRelation()
    {
        $this->finalData['relation_type']
            = \App::relation()->getListRelationTypeByModuleName($this->getModuleList());
    }

    /**
     *
     */
    public function importRelation()
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
    public function exportFeed()
    {
        $this->finalData['feed_type']
            = \App::feed()->getListTypeByModuleName($this->getModuleList());
    }

    /**
     *
     */
    public function exportExtension()
    {
        $this->finalData['core_extension']
            = \App::core()->extension()
            ->getListExtensionByModuleName($this->getModuleList());
    }

    /**
     *
     */
    public function importExtension()
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
    public function importFeed()
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
    public function exportNotification()
    {
        $this->finalData['notification_type']
            = \App::notification()->getListTypeByModuleName($this->getModuleList());
    }

    /**
     *
     */
    public function importNotification()
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
    public function exportInvitation()
    {
        $this->finalData['invitation_type']
            = \App::invitation()->getListTypeByModuleName($this->getModuleList());
    }


    /**
     *
     */
    public function importInvitation()
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
    public function exportTypes()
    {
        $this->finalData['core_type']
            = \App::core()->getListTypeByModuleName($this->getModuleList());
    }

    /**
     *
     */
    public function importTypes()
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
    public function exportAttribute()
    {
        $this->finalData['attribute_plugin']
            = \App::attribute()->getListPluginByModuleName($this->getModuleList());
    }

    /**
     *
     */
    public function importAttribute()
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
    public function exportNavigation()
    {
        $this->finalData['navigation'] =
            \App::nav()->getListNavigationByModuleName($this->getModuleList());

        $this->finalData['navigation_item']
            = \App::nav()->getListItemByModuleName($this->getModuleList());
    }

    /**
     *
     */
    public function importNavigation()
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
    public function exportAcl()
    {
        $this->finalData['acl_role']
            = \App::acl()->getListRoleByModuleName($this->getModuleList());

        $this->finalData['acl_group']
            = \App::acl()->getListGroupByModuleName($this->getModuleList());

        $this->finalData['acl_action']
            = \App::acl()->getListActionByModuleName($this->getModuleList());

        $this->finalData['acl_allow_data']
            = \App::acl()->exportAclAllowData($this->getModuleList());
    }

    /**
     *
     */
    public function importAcl()
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
            \App::acl()->importAclAllowData($this->finalData['acl_allow_data']);
        }
    }

    /**
     *
     */
    public function exportSetting()
    {
        $this->finalData['setting_action']
            = \App::settings()->getActionListByModuleName($this->getModuleList());

        $this->finalData['setting_value']
            = \App::settings()->getSettingListByModuleName($this->getModuleList());

    }


    /**
     *
     */
    public function importSetting()
    {

        if (!empty($this->finalData['setting_action'])) {
            foreach ($this->finalData['setting_action'] as $data) {
                unset($data['action_id']);
                \App::table('setting.setting_action')
                    ->insertIgnore($data);
            }
        }

        if (!empty($this->finalData['setting_value'])) {
            \App::settings()
                ->save($this->finalData['setting_value']);
        }
    }

    /**
     *
     */
    public function exportPhrase()
    {
        $this->finalData['phrase']
            = \App::phrase()->getListPhraseByModuleName($this->getModuleList());
    }

    /**
     *
     */
    public function importPhrase()
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
    public function exportTableStructural()
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
    public function importTableStructural()
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
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    /**
     * @return array
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * @param array $success
     */
    public function setSuccess($success)
    {
        $this->success = $success;
    }

    /**
     * @return array
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    /**
     * @param array $warnings
     */
    public function setWarnings($warnings)
    {
        $this->warnings = $warnings;
    }

    /**
     * @param $msg
     */
    public function addWarning($msg)
    {
        $this->warnings[] = $msg;
    }

    /**
     * @param $msg
     */
    public function addError($msg)
    {
        $this->errors[] = $msg;
    }

    /**
     * @param $msg
     */
    public function addSuccess($msg)
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