<?php

namespace Picaso\Package;

use Layout\Model\Layout;

/**
 * Class BaseInstaller
 *
 * @package Picaso\Package
 */
class BaseInstaller implements Installer
{
    /**
     * @var string
     */
    protected $exportKey;

    /**
     * @var   array
     */
    protected $installData = [];

    /**
     * @var array
     */
    protected $upgradeData = [];

    /**
     * @var array
     */
    protected $checksumData = [];

    /**
     * @var array
     */
    protected $moduleList = [];

    /**
     * @var array
     */
    protected $tableList = [];

    /**
     * @var array
     */
    protected $themeList = ['admin', 'default'];

    /**
     * @var array
     */
    protected $pathList = [];

    /**
     * @var array
     */
    protected $ignoreList = [
        '.git',
        '.svn',
        '.log',
        '.txt',
        '.zip',
        '.tar',
        '.conf.php',
        '/components/',
        '/doc/',
        '/docs/',
        '/examples/',
        '/example/',
        '/tests/',
        '/test/',
    ];

    /**
     * @return string
     */
    public function getExportKey()
    {
        return $this->exportKey;
    }

    /**
     * @param string $exportKey
     */
    public function setExportKey($exportKey)
    {
        $this->exportKey = $exportKey;
    }


    /**
     * @return array
     */
    public function getChecksumData()
    {
        return $this->checksumData;
    }

    /**
     * @param array $checksumData
     */
    public function setChecksumData($checksumData)
    {
        $this->checksumData = $checksumData;
    }

    /**
     * @return array
     */
    public function getPathList()
    {
        return $this->pathList;
    }

    /**
     * @param array $pathList
     */
    public function setPathList($pathList)
    {
        $this->pathList = $pathList;
    }

    /**
     * @return array
     */
    public function getInstallData()
    {
        return $this->installData;
    }

    /**
     * @param array $installData
     */
    public function setInstallData($installData)
    {
        $this->installData = $installData;
    }

    /**
     * @return array
     */
    public function getUpgradeData()
    {
        return $this->upgradeData;
    }

    /**
     * @param array $upgradeData
     */
    public function setUpgradeData($upgradeData)
    {
        $this->upgradeData = $upgradeData;
    }

    /**
     * @return array
     */
    public function getModuleList()
    {
        return $this->moduleList;
    }

    /**
     * @param array $moduleList
     */
    public function setModuleList($moduleList)
    {
        $this->moduleList = $moduleList;
    }

    /**
     * @return array
     */
    public function getThemeList()
    {
        return $this->themeList;
    }

    /**
     * @param array $themeList
     */
    public function setThemeList($themeList)
    {
        $this->themeList = $themeList;
    }

    /**
     * @return array
     */
    public function getTableList()
    {
        return $this->tableList;
    }

    /**
     * @param array $tableList
     */
    public function setTableList($tableList)
    {
        $this->tableList = $tableList;
    }

    /**
     *
     */
    public function export()
    {
        $this->installData = [];

        $this->installData['modules'] = $this->getModuleList();

        $this->installData['themes'] = $this->getThemeList();

        $this->exportExtension();
        $this->exportTableStructural();
        $this->exportPhraseSetting();
        $this->exportFeedSetting();
        $this->exportHookSetting();
        $this->exportInvitationSetting();
        $this->exportMailSetting();
        $this->exportAclSetting();
        $this->exportGlobalSetting();
        $this->exportAttributeSetting();
        $this->exportLayoutSetting();
        $this->exportNavigationSetting();
        $this->exportNotificationSetting();
        $this->exportTypeSetting();
        $this->exportChecksum();

        /**
         * Write down install data.
         */

        $this->writeToFile($this->getConfigFilename('data', 'install'), $this->installData);
        $this->writeToFile($this->getConfigFilename('checksum', 'install'), $this->checksumData);
        $this->archive($this->exportKey . '.zip');
    }

    /**
     * @return string
     */
    public function getConfigFilename()
    {
        $suffix = '-' . implode('-', func_get_args());

        return PICASO_ROOT_DIR . '/app/package/' . $this->exportKey . $suffix . '.json';
    }

    /**
     * @param $filename
     * @param $data
     */
    public function writeToFile($filename, &$data)
    {
        $dir = dirname($filename);

        if (!is_dir($dir))
        {
            if (!mkdir($dir, 0777, 1))
            {
                throw new \RuntimeException("Could not make dir to write file [$dir]");
            }
        }

        file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));

        @chmod($filename, 0777);

        // test file exsist

        if (!file_exists($filename))
        {
            throw new \RuntimeException("Could not make data file [$filename]");
        }

    }

    /**
     * @param array $package
     */
    public function install($package)
    {
        $this->installTableStructural();
        $this->installExtension();
        $this->installTypeSettings();
        $this->installGlobalSetting();
        $this->installPhraseSetting();
        $this->installAclSetting();
        $this->installNavigation();
        $this->installInvitation();
        $this->installFeedSetting();
        $this->installNotification();
        $this->installAttributeSetting();
        $this->installRelationSetting();
        $this->installLayoutSetting();
        $this->installMailSetting();
        $this->installHookSetting();
    }

    /**
     *
     */
    public function uninstall()
    {
        // TODO: Implement uninstall() method.
    }

    /**
     *
     */
    public function upgrade()
    {
        // TODO: Implement upgrade() method.
    }

    /**
     *
     */
    protected function exportHookSetting()
    {

        $this->installData['core_hook'] = \App::table('core.core_hook')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->toAssocs();
    }

    /**
     *
     */
    protected function installHookSetting()
    {
        if (!empty($this->installData['core_hook']))
        {
            foreach ($this->installData['core_hook'] as $data)
            {
                unset($data['id']);
                \App::table('core.core_hook')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     *
     */
    protected function exportMailSetting()
    {
        $this->installData['mail_template']
            = \App::table('mail.mail_template')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->toAssocs();
    }

    /**
     *
     */
    protected function installMailSetting()
    {
        if (!empty($this->installData['mail_template']))
        {
            foreach ($this->installData['mail_template'] as $data)
            {
                unset($data['template_id']);
                \App::table('mail.mail_template')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     *
     */
    protected function exportLayoutSetting()
    {
        $this->installData['layout_support_block']
            = \App::table('layout.layout_support_block')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->toAssocs();

        $this->installData['layout_page']
            = \App::table('layout.layout_page')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->toAssocs();

        $this->exportLayoutData();

    }

    /**
     * @return array
     */
    public function exportLayoutData()
    {
        $moduleList = $this->getModuleList();
        $themeList = $this->getThemeList();

        $select = \App::table('layout')
            ->select('layout')
            ->join(':layout_page', 'page', 'page.page_id=layout.page_id', null, null)
            ->columns('layout.*,page.page_name');


        if (!empty($moduleList))
        {
            $select->where('page.module_name IN ?', $moduleList);
        }

        if (!empty($themeList))
        {
            $select->where('theme_id IN ?', $themeList);
        }

        $result = [];

        // decorate data
        foreach ($select->toAssocs() as $item)
        {
            $result[] = [
                'page_name'   => $item['page_name'],
                'screen_size' => $item['screen_size'],
                'theme_id'    => $item['theme_id'],
                'listSection' => $this->_exportLayoutSectionListByLayoutId($item['layout_id']),
            ];
        }

        $this->installData['layout_data'] = $result;
    }

    /**
     * @param $layoutId
     *
     * @return array
     */
    public function _exportLayoutSectionListByLayoutId($layoutId)
    {
        $select = \App::table('layout.layout_section')
            ->select()
            ->where('layout_id=?', $layoutId);

        $result = [];

        foreach ($select->toAssocs() as $item)
        {

            $temp = $item;

            unset($temp['layout_id']);
            $temp['listBlock'] = $this->_exportLayoutBlockListBySectionId($item['section_id']);
            $result[] = $temp;
        }

        return $result;
    }

    /**
     * @param $sectionId
     *
     * @return array
     */
    public function _exportLayoutBlockListBySectionId($sectionId)
    {

        $select = \App::table('layout.layout_block')
            ->select('block')
            ->join(':layout_support_block', 'support', 'support.support_block_id=block.support_block_id', null, null)
            ->where('block.section_id=?', $sectionId)
            ->columns('block.*, support.block_class');

        $result = [];

        foreach ($select->toAssocs() as $item)
        {
            $result[] = $item;
        }

        return $result;

    }

    /**
     * @param $data
     */
    public function importLayoutData($data)
    {
        foreach ($data as $row)
        {

            $page = \App::table('layout.layout_page')
                ->select()
                ->where('page_name=?', $row['page_name'])
                ->one();

            if (!$page)
                continue;

            $layout = \App::table('layout')
                ->select()
                ->where('screen_size=?', $row['screen_size'])
                ->where('page_id=?', $page->getId())
                ->where('theme_id=?', $row['theme_id'])
                ->one();

            if ($layout)
                continue;

            $layout = new Layout([
                'screen_size' => $row['screen_size'],
                'page_id'     => $page->getId(),
                'theme_id'    => $row['theme_id'],
                'is_active'   => 1,
            ]);

            $layout->save();

            foreach ($row['listSection'] as $sectionData)
            {
                $sectionData['layout_id'] = $layout->getId();

                \App::table('layout.layout_section')
                    ->insertIgnore($sectionData);

                foreach ($sectionData['listBlock'] as $blockData)
                {
                    $supportBlock = \App::table('layout.layout_support_block')
                        ->select()
                        ->where('block_class=?', $blockData['block_class'])
                        ->one();

                    if (!$supportBlock)
                        continue;

                    $blockData['support_block_id'] = $supportBlock->getId();

                    \App::table('layout.layout_block')
                        ->insertIgnore($blockData);
                }
            }
        }
    }

    /**
     *
     */
    protected function installLayoutSetting()
    {
        if (!empty($this->installData['layout_support_block']))
        {
            foreach ($this->installData['layout_support_block'] as $data)
            {
                \App::table('layout.layout_support_block')
                    ->insertIgnore($data);
            }
        }

        if (!empty($this->installData['layout_page']))
        {
            foreach ($this->installData['layout_page'] as $data)
            {
                unset($data['page_id']);
                \App::table('layout.layout_page')
                    ->insertIgnore($data);
            }
        }

        if (!empty($this->installData['layout_data']))
        {
            $this->importLayoutData($this->installData['layout_data']);
        }
    }

    /**
     *
     */
    protected function afterInstall()
    {
        $this->installData = [];
    }

    /**
     *
     */
    protected function exportRelation()
    {
        $this->installData['relation_type']
            = \App::table('relation.relation_type')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->toAssocs();
    }

    /**
     *
     */
    protected function installRelationSetting()
    {
        if (!empty($this->installData['relation_type']))
        {
            foreach ($this->installData['relation_type'] as $data)
            {
                unset($data['type_id']);
                \App::table('relation.relation_type')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     *
     */
    protected function exportFeedSetting()
    {
        $this->installData['feed_type']
            = \App::table('feed.feed_type')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->toAssocs();
    }

    /**
     *
     */
    protected function installFeedSetting()
    {
        if (!empty($this->installData['feed_type']))
        {
            foreach ($this->installData['feed_type'] as $data)
            {
                \App::table('feed.feed_type')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     *
     */
    protected function exportExtension()
    {
        $this->installData['core_extension']
            = \App::table('core.core_extension')
            ->select()
            ->where('name IN ?', $this->getModuleList())
            ->toAssocs();
    }

    /**
     *
     */
    protected function installExtension()
    {
        if (!empty($this->installData['core_extension']))
        {
            foreach ($this->installData['core_extension'] as $data)
            {
                \App::table('core.core_extension')
                    ->insertIgnore($data);

                if (!empty($data['namespace']))
                {
                    \App::autoload()
                        ->addNamespace($data['namespace'], PICASO_MODULE_DIR . $data['path']);
                }
            }
        }
    }

    /**
     *
     */
    protected function exportNotificationSetting()
    {
        $this->installData['notification_type']
            = \App::table('notification.notification_type')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->toAssocs();
    }

    /**
     *
     */
    protected function installNotification()
    {
        if (!empty($this->installData['notification_type']))
        {
            foreach ($this->installData['notification_type'] as $data)
            {
                \App::table('notification.notification_type')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     *
     */
    protected function exportInvitationSetting()
    {
        $this->installData['invitation_type']
            = \App::table('invitation.invitation_type')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->toAssocs();
    }


    /**
     *
     */
    protected function installInvitation()
    {
        if (!empty($this->installData['invitation_type']))
        {
            foreach ($this->installData['invitation_type'] as $data)
            {
                \App::table('invitation.invitation_type')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     *
     */
    protected function exportTypeSetting()
    {
        $this->installData['core_type']
            = \App::table('core.core_type')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->toAssocs();
    }

    /**
     *
     */
    protected function installTypeSettings()
    {
        /**
         * insert types
         */
        if (!empty($this->installData['core_type']))
        {
            foreach ($this->installData['core_type'] as $data)
            {
                \App::table('core.core_type')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     *
     */
    protected function exportAttributeSetting()
    {
        $this->installData['attribute_plugin']
            = \App::table('attribute.attribute_plugin')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->toAssocs();
    }

    /**
     *
     */
    protected function installAttributeSetting()
    {
        // insert attribute plugins
        if (!empty($this->installData['attribute_plugin']))
        {
            foreach ($this->installData['attribute_plugin'] as $data)
            {
                \App::table('attribute.attribute_plugin')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     *
     */
    protected function exportNavigationSetting()
    {
        $this->installData['navigation'] =
            \App::table('navigation')
                ->select()
                ->where('module_name IN ?', $this->getModuleList())
                ->toAssocs();

        $this->installData['navigation_item']
            = \App::table('navigation.navigation_item')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->toAssocs();
    }

    /**
     *
     */
    protected function installNavigation()
    {
        // insert attribute plugins
        if (!empty($this->installData['navigation']))
        {
            foreach ($this->installData['navigation'] as $data)
            {
                \App::table('navigation')
                    ->insertIgnore($data);
            }
        }

        // insert attribute plugins
        if (!empty($this->installData['navigation_item']))
        {
            foreach ($this->installData['navigation_item'] as $data)
            {
                \App::table('navigation.navigation_item')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     *
     */
    protected function exportAclSetting()
    {
        $this->installData['acl_role'] = \App::table('acl.acl_role')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->columns('role_type, is_system, title, parent_role_id, is_super, is_admin, is_moderator, is_member, is_guest, module_name')
            ->toAssocs();

        $this->installData['acl_group']
            = \App::table('acl.acl_group')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->toAssocs();

        $this->installData['acl_action']
            = \App::table('acl.acl_action')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->columns('module_name, group_name, action_name, comment')
            ->toAssocs();

        /**
         * TODO: implement export allow data
         */
        $this->installData['acl_allow_data']
            = [];
    }

    /**
     *
     */
    protected function installAclSetting()
    {
        if (!empty($this->installData['acl_role']))
        {
            foreach ($this->installData['acl_role'] as $data)
            {
                \App::table('acl.acl_role')
                    ->insertIgnore($data);
            }
        }

        if (!empty($this->installData['acl_group']))
        {
            foreach ($this->installData['acl_group'] as $data)
            {
                \App::table('acl.acl_group')
                    ->insertIgnore($data);
            }
        }

        if (!empty($this->installData['acl_action']))
        {
            foreach ($this->installData['acl_action'] as $data)
            {
                unset($data['action_id']);
                \App::table('acl.acl_action')
                    ->insertIgnore($data);
            }
        }

        if (!empty($this->installData['acl_allow_data']))
        {
            /**
             * TODO: implement import allow data
             */
        }
    }

    /**
     *
     */
    protected function exportGlobalSetting()
    {
        $this->installData['setting_action']
            = \App::table('setting.setting_action')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->columns('module_name, action_group, action_name')
            ->toAssocs();

        if (true)
        {
            $items = \App::table('setting')
                ->select('c')
                ->where('a.module_name IN ?', $this->getModuleList())
                ->join(":setting_action", 'a', 'a.action_id=c.action_id', null, null)
                ->columns('c.value_text, a.*')
                ->toAssocs();

            $result = [];

            foreach ($items as $item)
            {
                if (empty($result[ $item['action_group'] ]))
                {
                    $result[ $item['action_group'] ] = [];
                }
                $value = json_decode($item['value_text'], 1);
                $result[ $item['action_group'] ][ $item['action_name'] ] = $value['val'];
            }

            $this->installData['setting_value'] = $result;
        }
    }


    /**
     *
     */
    protected function installGlobalSetting()
    {

        if (!empty($this->installData['setting_action']))
        {
            foreach ($this->installData['setting_action'] as $data)
            {
                unset($data['action_id']);
                \App::table('setting.setting_action')
                    ->insertIgnore($data);
            }
        }

        if (!empty($this->installData['setting_value']))
        {
            \App::settingService()
                ->save($this->installData['setting_value']);
        }
    }

    /**
     *
     */
    protected function exportPhraseSetting()
    {
        $this->installData['phrase']
            = \App::table('phrase')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->columns('module_name, is_active, phrase_group, phrase_name, default_value')
            ->toAssocs();
    }

    /**
     *
     */
    protected function installPhraseSetting()
    {
        if (!empty($this->installData['phrase']))
        {
            foreach ($this->installData['phrase'] as $data)
            {

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

        $allTableList = $db->getMaster()
            ->tables();

        $tables = [];
        $prefix = $db->getPrefix();

        $acceptTableList = $this->getTableList();

        if (!$acceptTableList)
            return [];


        foreach ($allTableList as $tableName)
        {

            $suffixName = substr($tableName, strlen($prefix));

            $match = false;

            foreach ($acceptTableList as $filterSuffix)
            {
                if ($filterSuffix != $suffixName) continue;
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

        $this->installData['tables'] = $tables;
    }

    /**
     *
     */
    protected function installTableStructural()
    {

        $tables = $this->installData['tables'];

        if (empty($tables))
            return;

        $db = \App::db();
        $prefix = $db->getPrefix();
        $master = $db->getMaster();

        $listExistsTable = $master->tables();

        foreach ($tables as $name => $createSql)
        {

            // check condition clear table if exists
            // fresh installation only
            if (array_search($prefix . $name, $listExistsTable) !== false) continue;

            $createSql = str_replace(':table_prefix_', $prefix, $createSql);

            $master->exec($createSql);
        }
    }

    /**
     * Generate check sum data
     *
     * @return array
     */
    protected function exportChecksum()
    {
        $result = [];
        $rootpath = realpath(PICASO_ROOT_DIR);

        foreach ($this->getPathList() as $path)
        {
            $realpath = realpath($rootpath . DIRECTORY_SEPARATOR . $path);

            /**
             * file is removed
             */
            if (empty($realpath))
            {
                continue;
            }

            if (is_file($realpath))
            {
                $key = trim(substr($realpath, strlen($rootpath)), DIRECTORY_SEPARATOR);
                $val = sha1(file_get_contents($realpath));
                $result[ $key ] = $val;
            }

            if (!is_dir($realpath))
            {
                continue;
            }

            $directory = new \RecursiveDirectoryIterator($realpath);
            $iterator = new \RecursiveIteratorIterator($directory);

            foreach ($iterator as $info)
            {
                $pathname = $info->getPathName();

                if ($info->isDir())
                {
                    continue;
                }

                if ($this->isIgnored($pathname))
                    continue;

                $val = sha1(file_get_contents($realpath));
                $key = trim(substr($pathname, strlen($rootpath)), DIRECTORY_SEPARATOR);
                $result[ $key ] = $val;
            }
        }

        $this->checksumData = $result;
    }

    /**
     * @param $destination
     *
     * @return string
     */
    public function archive($destination)
    {

        $destination = PICASO_ROOT_DIR . '/app/temp/package/' . $destination;

        echo $destination;

        if (!is_dir($dir = dirname($destination)))
        {
            if (!mkdir($dir, 0777, true))
                throw new \RuntimeException("Could not create $dir");
        }

        $rootpath = realpath(PICASO_ROOT_DIR);
        $zip = new \ZipArchive();

        if (false == ($zip->open($destination, \ZipArchive::CREATE)))
        {
            throw new \RuntimeException("Could not open $destination to write");
        }

        foreach ($this->getPathList() as $path)
        {

            $realpath = realpath($rootpath . DIRECTORY_SEPARATOR . $path);

            /**
             * file is removed
             */
            if (empty($realpath))
            {
                continue;
            }

            if (is_file($realpath))
            {
                $zipLocalName = str_replace(DIRECTORY_SEPARATOR, '/', trim(substr($realpath, strlen($rootpath)), DIRECTORY_SEPARATOR));

                $zip->addFile($realpath, $zipLocalName);
                continue;
            }

            if (!is_dir($realpath))
            {
                continue;
            }

            $directory = new \RecursiveDirectoryIterator($realpath);
            $iterator = new \RecursiveIteratorIterator($directory);

            foreach ($iterator as $info)
            {

                $pathname = $info->getPathName();

                $zipLocalName = str_replace(DIRECTORY_SEPARATOR, '/', trim(substr($pathname, strlen($rootpath)), DIRECTORY_SEPARATOR));

                if (!$zipLocalName) continue;

                if ($this->isIgnored($pathname))
                    continue;

                if ($info->isDir())
                {
                    $zip->addEmptyDir($zipLocalName);
                }

                if ($info->isFile())
                {
                    $zip->addFile($pathname, $zipLocalName);
                }
            }
        }

        $zip->close();

        @chmod($destination, 0777);

        return $destination;
    }

    /**
     * @param $pathname
     *
     * @return bool
     */
    public function isIgnored($pathname)
    {
        foreach ($this->ignoreList as $ignore)
        {
            if (strpos($pathname, $ignore))
                return true;
        }

        return false;
    }
}