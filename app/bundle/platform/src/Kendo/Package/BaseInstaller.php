<?php

namespace Kendo\Package;

use Platform\Layout\Model\Layout;

/**
 * @codeCoverageIgnore
 *
 * Class BaseInstaller
 *
 * @package Kendo\Package
 */
class BaseInstaller implements InstallerInterface
{

    /**
     * @var string
     */
    private $rootDir;

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
     * @return bool
     */
    public function hasModuleList()
    {
        return !empty($this->moduleList);
    }


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
        $this->archive();
    }

    /**
     * @return string
     */
    public function getConfigFilename()
    {
        $suffix = '-' . implode('-', func_get_args());

        return KENDO_ROOT_DIR . '/app/package/' . $this->exportKey . $suffix . '.json';
    }

    /**
     * @param $filename
     * @param $data
     */
    public function writeToFile($filename, &$data)
    {
        $dir = dirname($filename);

        if (!is_dir($dir)) {
            if (!mkdir($dir, 0777, 1)) {
                throw new \RuntimeException("Could not make dir to write file [$dir]");
            }
        }

        file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));

        @chmod($filename, 0777);

        // test file exsist

        if (!file_exists($filename)) {
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
        if (!$this->hasModuleList()) return;

        $this->installData['platform_core_hook']
            = \App::table('platform_core_hook')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->toAssocs();
    }

    /**
     *
     */
    protected function installHookSetting()
    {
        if (!empty($this->installData['platform_core_hook'])) {
            foreach ($this->installData['platform_core_hook'] as $data) {
                unset($data['id']);
                \App::table('platform_core_hook')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     *
     */
    protected function exportMailSetting()
    {
        if (!$this->hasModuleList()) return;

        $this->installData['platform_mail_template']
            = \App::table('platform_mail_template')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->toAssocs();
    }

    /**
     *
     */
    protected function installMailSetting()
    {
        if (!empty($this->installData['platform_mail_template'])) {
            foreach ($this->installData['platform_mail_template'] as $data) {
                unset($data['template_id']);
                \App::table('platform_mail_template')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     *
     */
    protected function exportLayoutSetting()
    {
        if (!$this->hasModuleList()) return;

        $this->installData['platform_layout_support_block']
            = \App::table('platform_layout_support_block')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->toAssocs();

        $this->installData['platform_layout_page']
            = \App::table('platform_layout_page')
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

        $select = \App::table('platform_layout')
            ->select('layout')
            ->join(':platform_layout_page', 'page', 'page.page_id=layout.page_id', null, null)
            ->columns('layout.*,page.page_name');


        if (!empty($moduleList)) {
            $select->where('page.module_name IN ?', $moduleList);
        }

        if (!empty($themeList)) {
            $select->where('theme_id IN ?', $themeList);
        }

        $result = [];

        // decorate data
        foreach ($select->toAssocs() as $item) {
            $result[] = [
                'page_name'   => $item['page_name'],
                'screen_size' => $item['screen_size'],
                'theme_id'    => $item['theme_id'],
                'listSection' => $this->_exportLayoutSectionListByLayoutId($item['layout_id']),
            ];
        }

        $this->installData['platform_layout_data'] = $result;
    }

    /**
     * @param $layoutId
     *
     * @return array
     */
    public function _exportLayoutSectionListByLayoutId($layoutId)
    {
        $select = \App::table('platform_layout_section')
            ->select()
            ->where('layout_id=?', $layoutId);

        $result = [];

        foreach ($select->toAssocs() as $item) {

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

        $select = \App::table('platform_layout_block')
            ->select('block')
            ->join(':platform_layout_support_block', 'support', 'support.support_block_id=block.support_block_id', null, null)
            ->where('block.section_id=?', $sectionId)
            ->columns('block.*, support.block_class');

        $result = [];

        foreach ($select->toAssocs() as $item) {
            $result[] = $item;
        }

        return $result;

    }

    /**
     * @param $data
     */
    public function importLayoutData($data)
    {
        foreach ($data as $row) {

            $page = \App::table('platform_layout_page')
                ->select()
                ->where('page_name=?', $row['page_name'])
                ->one();

            if (!$page)
                continue;

            $layout = \App::table('platform_layout')
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

            foreach ($row['listSection'] as $sectionData) {
                $sectionData['layout_id'] = $layout->getId();

                \App::table('platform_layout_section')
                    ->insertIgnore($sectionData);

                foreach ($sectionData['listBlock'] as $blockData) {
                    $supportBlock = \App::table('platform_layout_support_block')
                        ->select()
                        ->where('block_class=?', $blockData['block_class'])
                        ->one();

                    if (!$supportBlock)
                        continue;

                    $blockData['support_block_id'] = $supportBlock->getId();

                    \App::table('platform_layout_block')
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
        if (!empty($this->installData['platform_layout_support_block'])) {
            foreach ($this->installData['platform_layout_support_block'] as $data) {
                \App::table('platform_layout_support_block')
                    ->insertIgnore($data);
            }
        }

        if (!empty($this->installData['platform_layout_page'])) {
            foreach ($this->installData['platform_layout_page'] as $data) {
                unset($data['page_id']);
                \App::table('platform_layout_page')
                    ->insertIgnore($data);
            }
        }

        if (!empty($this->installData['platform_layout_data'])) {
            $this->importLayoutData($this->installData['platform_layout_data']);
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
        $this->installData['platform_relation_type']
            = \App::table('platform_relation_type')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->toAssocs();
    }

    /**
     *
     */
    protected function installRelationSetting()
    {
        if (!empty($this->installData['platform_relation_type'])) {
            foreach ($this->installData['platform_relation_type'] as $data) {
                unset($data['type_id']);
                \App::table('platform_relation_type')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     *
     */
    protected function exportFeedSetting()
    {
        if (!$this->hasModuleList()) return;

        $this->installData['platform_feed_type']
            = \App::table('platform_feed_type')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->toAssocs();
    }

    /**
     *
     */
    protected function installFeedSetting()
    {
        if (!empty($this->installData['feed_type'])) {
            foreach ($this->installData['feed_type'] as $data) {
                \App::table('platform_feed_type')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     *
     */
    protected function exportExtension()
    {
        if (!$this->hasModuleList()) return;

        $this->installData['platform_core_extension']
            = \App::table('platform_core_extension')
            ->select()
            ->where('name IN ?', $this->getModuleList())
            ->toAssocs();

    }


    /**
     *
     */
    protected function installExtension()
    {
        if (!empty($this->installData['platform_core_extension'])) {
            foreach ($this->installData['platform_core_extension'] as $data) {
                \App::table('platform_core_extension')
                    ->insertIgnore($data);

                if (!empty($data['namespace'])) {
                    \App::autoload()
                        ->register($data['namespace'], KENDO_BUNDLE_DIR . $data['path']);
                }
            }
        }
    }

    /**
     *
     */
    protected function exportNotificationSetting()
    {
        if (!$this->hasModuleList()) return;

        $this->installData['platform_notification_type']
            = \App::table('platform_notification_type')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->toAssocs();
    }

    /**
     *
     */
    protected function installNotification()
    {
        if (!empty($this->installData['platform_notification_type'])) {
            foreach ($this->installData['platform_notification_type'] as $data) {
                \App::table('platform_notification_type')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     *
     */
    protected function exportInvitationSetting()
    {
        if (!$this->hasModuleList()) return;

        $this->installData['platform_invitation_type']
            = \App::table('platform_invitation_type')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->toAssocs();
    }


    /**
     *
     */
    protected function installInvitation()
    {
        if (!empty($this->installData['platform_invitation_type'])) {
            foreach ($this->installData['platform_invitation_type'] as $data) {
                \App::table('platform_invitation_type')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     *
     */
    protected function exportTypeSetting()
    {

        if (!$this->hasModuleList()) return;

        $this->installData['platform_core_type']
            = \App::table('platform_core_type')
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
        if (!empty($this->installData['platform_core_type'])) {
            foreach ($this->installData['platform_core_type'] as $data) {
                \App::table('platform_core_type')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     *
     */
    protected function exportAttributeSetting()
    {
        if (!$this->hasModuleList()) return;
    }

    /**
     *
     */
    protected function installAttributeSetting()
    {
    }

    /**
     *
     */
    protected function exportNavigationSetting()
    {
        if (!$this->hasModuleList()) return;

        $this->installData['platform_navigation'] =
            \App::table('platform_navigation')
                ->select()
                ->where('module_name IN ?', $this->getModuleList())
                ->toAssocs();

        $this->installData['platform_navigation_item']
            = \App::table('platform_navigation_item')
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
        if (!empty($this->installData['platform_navigation'])) {
            foreach ($this->installData['platform_navigation'] as $data) {
                \App::table('navigation')
                    ->insertIgnore($data);
            }
        }

        // insert attribute plugins
        if (!empty($this->installData['platform_navigation_item'])) {
            foreach ($this->installData['platform_navigation_item'] as $data) {
                \App::table('platform_navigation_item')
                    ->insertIgnore($data);
            }
        }
    }

    /**
     *
     */
    protected function exportAclSetting()
    {
        if (!$this->hasModuleList()) return;

        $this->installData['platform_acl_role'] = \App::table('platform_acl_role')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->columns('role_type, is_system, title, parent_role_id, is_super, is_admin, is_moderator, is_member, is_guest, module_name')
            ->toAssocs();

        $this->installData['platform_acl_group']
            = \App::table('platform_acl_group')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->toAssocs();

        $this->installData['platform_acl_action']
            = \App::table('platform_acl_action')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->columns('module_name, group_name, action_name, comment')
            ->toAssocs();

        /**
         * TODO: implement export allow data
         */
        $this->installData['platform_acl_allow']
            = [];
    }

    /**
     *
     */
    protected function installAclSetting()
    {

        if (!empty($this->installData['platform_acl_role'])) {
            foreach ($this->installData['platform_acl_role'] as $data) {
                \App::table('platform_acl_role')
                    ->insertIgnore($data);
            }
        }

        if (!empty($this->installData['platform_acl_group'])) {
            foreach ($this->installData['platform_acl_group'] as $data) {
                \App::table('platform_acl_group')
                    ->insertIgnore($data);
            }
        }

        if (!empty($this->installData['platform_acl_action'])) {
            foreach ($this->installData['platform_acl_action'] as $data) {
                unset($data['action_id']);
                \App::table('platform_acl_action')
                    ->insertIgnore($data);
            }
        }

        if (!empty($this->installData['acl_allow_data'])) {
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
        if (!$this->hasModuleList()) return;

        $this->installData['platform_setting_action']
            = \App::table('platform_setting_action')
            ->select()
            ->where('module_name IN ?', $this->getModuleList())
            ->columns('module_name, action_group, action_name')
            ->toAssocs();

        if (true) {
            $items = \App::table('platform_setting')
                ->select('c')
                ->where('a.module_name IN ?', $this->getModuleList())
                ->join(":platform_setting_action", 'a', 'a.action_id=c.action_id', null, null)
                ->columns('c.value_text, a.*')
                ->toAssocs();

            $result = [];

            foreach ($items as $item) {
                if (empty($result[ $item['action_group'] ])) {
                    $result[ $item['action_group'] ] = [];
                }
                $value = json_decode($item['value_text'], 1);
                $result[ $item['action_group'] ][ $item['action_name'] ] = $value['val'];
            }

            $this->installData['platform_setting_value'] = $result;
        }
    }


    /**
     *
     */
    protected function installGlobalSetting()
    {

        if (!empty($this->installData['platform_setting_action'])) {
            foreach ($this->installData['platform_setting_action'] as $data) {
                unset($data['action_id']);
                \App::table('platform_setting_action')
                    ->insertIgnore($data);
            }
        }

        if (!empty($this->installData['platform_setting_value'])) {
            \App::settingService()
                ->save($this->installData['platform_setting_value']);
        }
    }

    /**
     *
     */
    protected function exportPhraseSetting()
    {
        if (!$this->hasModuleList()) return;

        $this->installData['platform_phrase']
            = \App::table('platform_phrase')
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
        if (!empty($this->installData['platform_phrase'])) {
            foreach ($this->installData['platform_phrase'] as $data) {

                unset($data['phrase_id']);

                \App::table('platform_phrase')
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


        foreach ($allTableList as $tableName) {

            $suffixName = substr($tableName, strlen($prefix));

            $match = false;

            foreach ($acceptTableList as $filterSuffix) {
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

        foreach ($tables as $name => $createSql) {

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

        $rootPath = realpath(KENDO_ROOT_DIR);

        $includePaths = $this->getPathList();

        foreach ($includePaths as $includePath) {

            $includePath = realpath($rootPath . DIRECTORY_SEPARATOR . $includePath);

            /**
             * file is removed
             */
            if (empty($includePath)) {
                continue;
            }

            if (is_file($includePath)) {
                $key = $this->correctPath($includePath);
                $val = sha1(file_get_contents($includePath));
                $result[ $key ] = $val;
            }

            if (!is_dir($includePath)) {
                continue;
            }

            $directory = new \RecursiveDirectoryIterator($includePath);
            $iterator = new \RecursiveIteratorIterator($directory);

            foreach ($iterator as $info) {
                $pathname = $info->getPathName();

                if ($info->isDir()) {
                    continue;
                }

                if ($this->isIgnored($pathname))
                    continue;

                $val = sha1(file_get_contents($includePath));
                $key = $this->correctPath($pathname);
                $result[ $key ] = $val;
            }
        }

        $this->checksumData = $result;
    }

    /**
     *
     */
    public function archive()
    {
        $includePaths = $this->getPathList();
        $rootPath = realpath(KENDO_ROOT_DIR);

        $destinationFilename = KENDO_TEMP_DIR . '/package/' . $this->getExportKey() . '.zip';

        if (file_exists($destinationFilename)) {
            if (!@unlink($destinationFilename)) {
                throw new \RuntimeException('Archive file "%s" exsist!');
            }
        }

        $zip = new \ZipArchive();

        if (false == ($zip->open($destinationFilename, \ZipArchive::CREATE))) {
            throw new \RuntimeException('Can not create zip archive "%s"', $destinationFilename);
        }

        $fileCounter = 0;

        foreach ($includePaths as $includePath) {

            $includePath = realpath($rootPath . DIRECTORY_SEPARATOR . $includePath);

            if (!$includePath) continue;

            if ($this->isIgnored($includePath)) continue;

            if (is_file($includePath)) {
                $temp = $this->correctPath($includePath);
                if (!$temp) continue;
                $zip->addFile($includePath, $temp);
                $fileCounter++;
                continue;
            }


            if (!is_dir($includePath)) continue;

            $directory = new \RecursiveDirectoryIterator($includePath, \RecursiveDirectoryIterator::SKIP_DOTS);
            $iterator = new \RecursiveIteratorIterator($directory);

            foreach ($iterator as $info) {

                $pathname = $info->getPathName();

                if ($this->isIgnored($pathname)) continue;

                $temp = $this->correctPath($pathname);

                if (!$temp) continue;

                if ($info->isDir()) {
                    $zip->addEmptyDir($temp);
                }
                if ($info->isFile()) {
                    $fileCounter++;
                    $zip->addFile($pathname, $temp);
                }
            }
        }

        $zip->close();


        if (0 == $fileCounter) {
            throw new \RuntimeException("Unexpected pathList options, there no files.");
        }

        if (!file_exists($destinationFilename)) {
            throw new \RuntimeException(sprintf('Could not create "%s"', $destinationFilename));
        }

        @chmod($destinationFilename, 0777);

        return true;
    }

    /**
     * For performance, please ensure $pathname and $rootpath is result of realpath() call
     *
     * @param string $pathname
     *
     * @return string
     */
    public function correctPath($pathname)
    {
        return substr($pathname, strlen($this->getRootDir()));
    }

    /**
     * @param $pathname
     *
     * @return bool
     */
    public function isIgnored($pathname)
    {
        foreach ($this->ignoreList as $ignore) {
            if (strpos($pathname, $ignore))
                return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public function getRootDir()
    {
        if (null == $this->rootDir) {
            $this->rootDir = realpath(KENDO_ROOT_DIR);
        }

        return $this->rootDir;
    }

    /**
     * @param $destination
     *
     * @return bool
     */
    protected function validateDestination($destination)
    {
        $dir = dirname($destination);

        if (file_exists($destination)) {
            if (!@unlink($destination)) {
                throw new \RuntimeException("Could not overwrite $destination");
            }
        }

        if (!is_dir($dir)) {
            if (!@mkdir($dir)) {
                throw new \InvalidArgumentException("Could not open $dir to build compress file.");
            }
            @chmod($dir, 0777);
        }

        return true;
    }

    /**
     * @param string $filename
     * @param string $destinationDirectory
     */
    public function extractZip($filename, $destinationDirectory)
    {

        if (!file_exists($filename) or !is_readable($filename)) {
            throw new \InvalidArgumentException('Unexpected filename "%s" ', $filename);
        }

        $this->ensureDirectoryExistsAndEmpty($destinationDirectory);

        $zip = new \ZipArchive();
        $zip->open($filename);
        $zip->extractTo($destinationDirectory);
        $zip->close();
    }

    /**
     * @param $destination
     */
    public function ensureDirectoryExistsAndEmpty($destination)
    {
        if (!is_dir($destination)) return;

        $directory = new \RecursiveDirectoryIterator($destination, \RecursiveDirectoryIterator::SKIP_DOTS);
        $iterator = new \RecursiveIteratorIterator($directory, \RecursiveIteratorIterator::CHILD_FIRST);

        foreach ($iterator as $info) {
            $pathname = $info->getPathName();

            if ($info->isDir()) {
                if (!@rmdir($pathname)) {
                    throw new \InvalidArgumentException("Could not remove $pathname");
                }
            }

            if ($info->isFile()) {
                if (!@unlink($pathname)) {
                    throw new \InvalidArgumentException("Could not remove $pathname");
                }
            }

        }
        @rmdir($destination);
    }
}