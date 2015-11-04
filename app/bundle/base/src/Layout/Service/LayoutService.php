<?php
namespace Layout\Service;

use Layout\Model\Layout;
use Layout\Model\LayoutBlock;
use Layout\Model\LayoutSection;
use Layout\Model\LayoutSetting;
use Picaso\Layout\Block;
use Picaso\Layout\BlockParams;
use Picaso\Layout\BlockWrapper;
use Picaso\Layout\LayoutLoaderInterface;
use Picaso\Layout\Manager;
use Picaso\Layout\Navigation;
use Picaso\View\View;

/**
 * Class LayoutService
 *
 * @package Core\Service
 */
class LayoutService implements LayoutLoaderInterface, Manager
{
    /**
     * Root page name to search
     */
    const PAGE_ROOT = 'core_default';

    /**
     * Default template id
     */
    const DEFAULT_TEMPLATE_ID = 'default';

    /**
     * Screen tablet
     */
    const SCREEN_TABLET = 'tablet';

    /**
     * Screen mobile
     */
    const SCREEN_MOBILE = 'mobile';

    /**
     * Screen desktop
     */
    const SCREEN_DESKTOP = 'desktop';

    /**
     * @var LayoutLoaderInterface
     */
    protected $loader;

    /**
     * @var string
     */
    protected $templateId;

    /**
     * @var string
     */
    protected $themeId;

    /**
     * @var string
     */
    protected $screenSize;
    /**
     * @var string
     */
    protected $pageName = 'core_default';

    /**
     * @var string
     */
    protected $masterScript = 'layout/master/default';


    /**
     * @var array
     */
    protected $blockWrappers = [
        'none'    => '\Picaso\Layout\BlockWrapperNone',
        'default' => '\Picaso\Layout\BlockWrapperDefault',
        'panel'   => '\Picaso\Layout\BlockWrapperPanel',
    ];

    /**
     * @var array
     */
    protected $blockWrapperInstances = [];

    /**
     * @var \Picaso\Layout\Navigation
     */
    protected $primaryNavigation;

    /**
     * @var \Picaso\Layout\Navigation
     */
    protected $secondaryNavigation;

    /**
     * LayoutService constructor.
     */
    public function __construct()
    {
        $themeId = null;
        if (!empty($_COOKIE['themeId'])) {
            $themeId = $_COOKIE['themeId'];
        }



        $themeData = $this->getThemeData($themeId);

        $this->setTemplateId($themeData['template_id']);
        $this->themeId = $themeData['theme_id'];

        \App::viewFinder()
            ->setPaths($themeData['view_paths']);
    }

    /**
     * @param $themeId
     *
     * @return array
     */
    public function getThemeData($themeId)
    {
        return \App::cache()
            ->get(['layout', 'getThemeData', $themeId], 0, function () use ($themeId) {
                return $this->_getThemeData($themeId);
            });
    }

    /**
     * @param $themeId
     *
     * @return array
     */
    public function _getThemeData($themeId)
    {
        $theme = $this->findThemeById($themeId);

        if (!$theme)
            $theme = $this->findDefaultTheme();

        $template = $this->findTemplateById($theme->getTemplateId());

        return [
            'theme_id'           => $theme->getId(),
            'parent_theme_id'    => $theme->getParentThemeId(),
            'template_id'        => $template->getId(),
            'parent_template_id' => $template->getParentTemplateId(),
            'super_template_id'  => $template->getSuperTemplateId(),
            'view_paths'         => $template->getViewFinderPaths(),
        ];
    }

    /**
     * @return \Layout\Model\LayoutTheme
     */
    public function findDefaultTheme()
    {
        $theme = \App::table('layout.layout_theme')
            ->select()
            ->where('is_default=?', 1)
            ->one();

        if (!$theme)
            $theme = \App::table('layout.layout_theme')
                ->select()
                ->where('theme_id=?', 'default')
                ->one();

        return $theme;
    }

    /**
     * @param $themeId
     *
     * @return \Layout\Model\LayoutTheme
     */
    public function findThemeById($themeId)
    {
        return \App::table('layout.layout_theme')
            ->findById((string)$themeId);
    }

    /**
     * @return \Picaso\Layout\Navigation
     */
    public function getPrimaryNavigation()
    {
        if (null == $this->primaryNavigation) {
            $this->primaryNavigation = new Navigation();
        }

        return $this->primaryNavigation;
    }

    /**
     * @param \Picaso\Layout\Navigation $primaryNavigation
     */
    public function setPrimaryNavigation($primaryNavigation)
    {
        $this->primaryNavigation = $primaryNavigation;
    }

    /**
     * @return \Picaso\Layout\Navigation
     */
    public function getSecondaryNavigation()
    {
        if (null == $this->secondaryNavigation) {
            $this->secondaryNavigation = new Navigation();
        }

        return $this->secondaryNavigation;
    }

    /**
     * @param \Picaso\Layout\Navigation $secondaryNavigation
     */
    public function setSecondaryNavigation($secondaryNavigation)
    {
        $this->secondaryNavigation = $secondaryNavigation;
    }


    /**
     * @param string $navId
     * @param string $parentId
     * @param array  $active
     *
     * @return LayoutService
     */
    public function setupPrimaryNavigation($navId, $parentId = null, $active = [])
    {
        $this->getPrimaryNavigation()
            ->setup($navId, $parentId, $active);

        return $this;
    }

    /**
     * @param string $navId
     * @param string $parentId
     * @param array  $active
     *
     * @return LayoutService
     */
    public function setupSecondaryNavigation($navId, $parentId = null, $active = [])
    {
        $this->getSecondaryNavigation()
            ->setup($navId, $parentId, $active);

        return $this;
    }

    /**
     * @return string
     */
    public function getThemeId()
    {
        return $this->themeId;
    }

    /**
     * @param string $themeId
     */
    public function setThemeId($themeId)
    {
        $this->themeId = $themeId;
    }

    /**
     * @param array $params
     * @param int   $page
     * @param int   $limit
     *
     * @return \Picaso\Paging\PagingInterface
     */
    public function loadAdminLayoutPagePaging($params = [], $page = 1, $limit = 10)
    {
        $select = \App::table('layout.layout_page')
            ->select()
            ->order('module_name, page_name', 1);

        if (!empty($params['admin'])) {
//            $select->where('is_admin =?', 1);
        } else {
//            $select->where('is_admin =?', 0);
        }


        if (!empty($params['module'])) {
            $select->where('module_name IN ?', explode(',', $params['module']));
        } else {
            $select->where('module_name IN ?', \App::extensions()->getActiveModuleNames());
        }

        return $select->paging($page, $limit);
    }

    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Picaso\Paging\PagingInterface
     */
    public function loadAdminTemplatePaging($query = [], $page = 1, $limit = 10)
    {
        $select = \App::table('layout.layout_template')
            ->select();

        if (!empty($query)) {
            // do filter there
        }

        return $select->paging($page, $limit);
    }

    /**
     * @param array $params
     * @param int   $page
     * @param int   $limit
     *
     * @return \Picaso\Paging\PagingInterface
     */
    public function loadThemePaging($params = [], $page = 1, $limit = 10)
    {
        $select = \App::table('layout.layout_theme')
            ->select();

        if (!empty($params)) {
            // do filter there
        }

        return $select->paging($page, $limit);

    }

    /**
     * @param string $blockId
     *
     * @return \Layout\Model\LayoutBlock
     */
    public function findBlockById($blockId)
    {

        return \App::table('layout.layout_block')
            ->findById((string)$blockId);
    }

    /**
     * @param $layoutId
     *
     * @return \Layout\Model\Layout
     */
    public function findLayoutById($layoutId)
    {
        return \App::table('layout')
            ->findById($layoutId);
    }

    /**
     * @param $pageName
     * @param $templateId
     * @param $screenSize
     *
     * @return \Layout\Model\Layout
     * @throws \Exception
     */
    public function findLayout($pageName, $templateId, $screenSize)
    {
        $pageId = $this->findPageIdByPageName($pageName);

        return \App::table('layout')
            ->select('layout')
            ->where('page_id=?', $pageId)
            ->where('screen_size=?', $screenSize)
            ->where('template_id=?', $templateId)
            ->one();
    }

    /**
     * @param string $pageName
     *
     * @return int
     * @throws \InvalidArgumentException
     */
    public function findPageIdByPageName($pageName)
    {
        $page = $this->findPageByName($pageName);

        if (!$page) {
            throw new \InvalidArgumentException("Page {$pageName} does not exists");
        }

        return (int)$page->getId();
    }

    /**
     * @param $pageName
     *
     * @return \Layout\Model\LayoutPage
     */
    public function findPageByName($pageName)
    {
        return \App::table('layout.layout_page')
            ->select('t')
            ->where('page_name=?', $pageName)
            ->one();

    }

    /**
     * @param string $pageName
     * @param string $templateId
     * @param string $screenSize
     * @param array  $params
     *
     * @return \Layout\Model\Layout
     */
    public function createLayout($pageName, $templateId, $screenSize, $params = [])
    {
        $pageId = $this->findPageIdByPageName($pageName);

        $data = array_merge([
            'page_id'     => $pageId,
            'screen_size' => $screenSize,
            'template_id' => $templateId,
            'is_active'   => 1,
        ], $params);

        $layout = \App::table('layout')
            ->fetchNew($data);

        $layout->save();

        return $layout;

    }


    /**
     * @return array
     */
    public function loadSupportSections()
    {
        $select = \App::table('layout.layout_support_section')
            ->select()
            ->order('support_section_order', 1);

        return $select->all();
    }

    /**
     * @param string $pageName
     * @param string $templateId
     * @param string $screenSize
     *
     * @return array [layoutText: string]
     */
    public function loadDataForRender($pageName, $templateId, $screenSize)
    {
        $layoutId = $this->findClosestLayoutId($pageName, $screenSize, $templateId);

        return $this->loadLayoutDataForRender($layoutId);
    }


    /**
     * Find template id to match layout
     *
     * @param string $pageName
     * @param string $screenSize
     * @param string $templateId
     *
     * @return int
     */
    public function findClosestLayoutId($pageName, $screenSize, $templateId)
    {

        $templateIdList = $this->getListAncestorsTemplateId($templateId);
        $pageIdList = $this->getListAncestorsPageId($pageName);

        $select = \App::table('layout')
            ->select()
            ->where('page_id IN ?', $pageIdList);


        if (!empty($templateIdList))
            $select->where('template_id IN ?', $templateIdList);


        $items = $select->toAssocs();

        $map = [];

        foreach ($items as $offset => $item) {
            $map[ $item['template_id'] ][ $item['screen_size'] ][ $item['page_id'] ] = $item['layout_id'];
        }

        foreach ($templateIdList as $templateId) {
            foreach ([$screenSize, self::SCREEN_DESKTOP] as $size) {
                foreach ($pageIdList as $pageId) {
                    if (empty($map[ $templateId ])) continue;
                    if (empty($map[ $templateId ][ $size ])) continue;
                    if (empty($map[ $templateId ][ $size ][ $pageId ])) continue;

                    return $map[ $templateId ][ $size ][ $pageId ];
                }
            }
        }

        return null;
    }

    /**
     * @param $templateId
     *
     * @return \Layout\Model\LayoutTemplate
     */
    public function findTemplateById($templateId)
    {
        return \App::table('layout.layout_template')
            ->findById($templateId);
    }

    /**
     * @param $pageName
     *
     * @return \Layout\Model\LayoutPage
     */
    public function findLayoutPageByName($pageName)
    {
        return \App::table('layout.layout_page')
            ->select()
            ->where('page_name=?', $pageName)
            ->one();
    }

    /**
     * @param $templateId
     *
     * @return array
     */
    public function getTemplateInfo($templateId)
    {
        $file = PICASO_TEMPLATE_DIR . '/' . $templateId . '/setting.json';

        if (!file_exists($file))
            throw new \InvalidArgumentException("Can not find template settings.");

        return json_decode(file_get_contents($file), true);
    }

    /**
     * Get template block settings.
     * This method is used to edit configure layout for main action content.
     *
     * @param string $templateId
     * @param string $layoutType
     * @param string $path
     *
     * @return array
     */
    public function getTemplateBlockRenderSettings($templateId, $layoutType, $path)
    {
        /**
         * Get page for content but there no update.
         */

        if ('header' == $layoutType)
            $path = 'base/layout/block/site-header';


        if ('footer' == $layoutType)
            $path = 'base/layout/block/site-footer';

        return $this->_getTemplateBlockRenderSettings($path, $templateId);
    }

    /**
     * Get template block settings.
     * This method is used to edit configure layout for main action content.
     *
     * @param string $path
     *
     * @return array
     */
    public function getTemplateSupportBlockSettings($path)
    {
        /**
         * Get page for content but there no update.
         */

        $templateId = $this->getTemplateId();

        $directory = PICASO_TEMPLATE_DIR . '/' . $templateId . '/' . $path;

        if (!is_dir($directory)) {
            $directory = PICASO_TEMPLATE_DIR . '/default/' . $path;
        }

        $iterator = new \DirectoryIterator ($directory);

        $files = [];


        foreach ($iterator as $info) {

            if (!$info->isFile()) continue;

            $baseName = $info->getBasename('.tpl');
            $fileName = $info->__toString();

            if (strpos($baseName, '-admin')) continue;

            if ($baseName == $fileName) continue;

            // mobile version of template
            if (strpos($baseName, '.mobile')) continue;

            if (strpos($baseName, '.logged')) continue;

            $fileJson = $directory . '/' . $baseName . '.json';

            $json = [
                'label'    => $baseName,
                'note'     => $baseName,
                'settings' => [],
            ];

            if (file_exists($fileJson))
                $json = array_merge($json, json_decode(file_get_contents($fileJson), true));

            $files [ $baseName ] = $json;
        }

        return $files;
    }

    /**
     * @param $path
     * @param $script
     * @param $templateId
     *
     * @return array
     */
    public function getTemplateBlockRenderSetting($path, $script, $templateId = 'default')
    {
        $file = PICASO_TEMPLATE_DIR . '/' . $templateId . '/' . $path . '/' . $script . '.json';

        if (file_exists($file))
            return json_decode(file_get_contents($file), true);

        return [
            'name'     => $script,
            'note'     => $script,
            'settings' => [],
        ];
    }


    /**
     * @param string $path
     * @param string $templateId
     *
     * @return array
     */
    public function _getTemplateBlockRenderSettings($path, $templateId = 'default')
    {
        $directory = PICASO_TEMPLATE_DIR . '/' . $templateId . '/' . $path;

        $iterator = new \DirectoryIterator ($directory);

        $files = [];


        foreach ($iterator as $info) {

            if (!$info->isFile()) continue;

            $baseName = $info->getBasename('.tpl');
            $fileName = $info->__toString();

            if ($baseName == $fileName) continue;

            // mobile version of template
            if (strpos($baseName, '.mobile')) continue;

            if (strpos($baseName, '.logged')) continue;

            if (strpos($baseName, '-admin')) continue;

            $fileJson = $directory . '/' . $baseName . '.json';

            $json = [
                'label'    => $baseName,
                'note'     => $baseName,
                'settings' => [],
            ];

            if (file_exists($fileJson))
                $json = array_merge($json, json_decode(file_get_contents($fileJson), true));

            $files [ $baseName ] = $json;
        }

        return $files;
    }

    /**
     * @param $layoutType
     * @param $pageName
     * @param $screenSize
     * @param $templateId
     *
     * @return LayoutSetting
     */
    public function getLayoutSettings($layoutType, $pageName, $screenSize, $templateId)
    {
        if (!$templateId)
            $templateId = self::DEFAULT_TEMPLATE_ID;

        if (!$pageName)
            $pageName = self::PAGE_ROOT;

        /**
         *
         */
        $page = $this->findLayoutPageByName($pageName);

        if (!$page)
            throw new \InvalidArgumentException();

        if (!$screenSize)
            $screenSize = self::SCREEN_DESKTOP;

        $select = \App::table('layout.layout_setting')
            ->select()
            ->where('screen_size=?', $screenSize)
            ->where('layout_type=?', $layoutType)
            ->where('template_id=?', $templateId)
            ->where('page_id=?', $page->getId());

        $setting = $select->one();

        if (!$setting) {
            $setting = new LayoutSetting([
                'template_id'         => $templateId,
                'layout_type'         => $layoutType,
                'screen_size'         => $screenSize,
                'page_id'             => $page->getId(),
                'is_active'           => 1,
                'setting_params_text' => '[]',
            ]);
            $setting->save();
        }

        return $setting;
    }

    /**
     * @param string $pageName
     *
     * @return string
     */
    public function findParentPageName($pageName)
    {
        return \App::table('layout.layout_page')
            ->select('t')
            ->where('page_name=?', $pageName)
            ->field('parent_page_name');
    }

    /**
     * @param $templateId
     *
     * @return array
     */
    public function getListAncestorsTemplateId($templateId)
    {
        $result = [$templateId];

        $template = $this->findTemplateById($templateId);

        if (null == $template)
            return $result;

        if (null != $template->getParentTemplateId())
            $result[] = $template->getParentTemplateId();

        if (null != $template->getSuperTemplateId())
            $result[] = $template->getSuperTemplateId();

        if (empty($result))
            $result[] = 'default';

        return $result;
    }

    /**
     * @param $pageName
     *
     * @return array
     */
    public function getListAncestorsPageName($pageName)
    {
        $result = [];

        while ($page = $this->findPageByName($pageName)) {

            $result[] = $page->getPageName();

            $tmp = $page->getParentPageName();

            if (empty($tmp))
                break;

            // check loop
            if (array_search($tmp, $result) > -1)
                break;

            $pageName = $tmp;
        }

        if (empty($result)) {
            $result[] = $this->getRootPage()->getPageName();
        }

        return $result;
    }

    /**
     * @param $pageName
     *
     * @return array
     */
    public function getListAncestorsPageId($pageName)
    {

        $map = [];
        $result = [];


        while ($page = $this->findPageByName($pageName)) {

            $map[] = $page->getPageName();

            $result[] = $page->getId();

            $tmp = $page->getParentPageName();

            if (empty($tmp))
                break;

            // check loop
            if (array_search($tmp, $map) > -1)
                break;

            $pageName = $tmp;
        }

        if (empty($result)) {
            $result[] = $this->getRootPage()->getId();
        }

        return $result;
    }

    /**
     * @return \Layout\Model\LayoutPage
     */
    public function getRootPage()
    {
        return $this->findPageByName(self::PAGE_ROOT);
    }

    /**
     * @param int $layoutId
     *
     * @return array
     */
    public function loadLayoutDataForRender($layoutId)
    {

        /**
         * load section by layout id.
         */
        $sections = $this->loadSectionsByLayoutId($layoutId);
        $response = ['sections' => []];


        foreach ($sections as $section) {
            if (!$section instanceof LayoutSection) continue;

            $sectionTemplate = $this->getConvertSectionTemplate($section->getSectionTemplate());

            $sectionId = $section->getId();
            $response['sections'][ $sectionId ] = [
                'locations'        => $this->loadSectionData($sectionId),
                'section_template' => $sectionTemplate,
                'section_id'       => $sectionId,
            ];
        }

        return $response;
    }

    /**
     * @param string $fromId
     * @param string $templateId
     *
     * @return string
     */
    public function getConvertSectionTemplate($fromId, $templateId = null)
    {
        if (null == $templateId)
            $templateId = $this->getTemplateId();

        if ($templateId == 'default')
            return $fromId;

        $toId = \App::table('layout.layout_section_convert')
            ->select()
            ->where('template_id=?', $templateId)
            ->where('from_id=?', $fromId)
            ->field('to_id');

        if (!empty($toId))
            return $toId;

        return $fromId;
    }

    /**
     * @param int $layoutId
     * @param int $onlyActiveValue
     *
     * @return array
     */
    public function loadSectionsByLayoutId($layoutId, $onlyActiveValue = null)
    {
        $select = \App::table('layout.layout_section')
            ->select()
            ->where('layout_id=?', $layoutId)
            ->order('section_order', 1);

        if (null !== $onlyActiveValue) {
            $select->where('section_active=?', $onlyActiveValue ? 1 : 0);
        }

        return $select->all();
    }

    /**
     * @param $sectionId
     *
     * @return array
     */
    public function loadSectionData($sectionId)
    {
        $maxLevel = 3;
        $rows = [];

        $supportBlockTable = \App::table('layout.layout_support_block')->getName();


        $allBlocks = \App::table('layout.layout_block')
            ->select('b')
            ->join($supportBlockTable, 's', 's.support_block_id=b.support_block_id', null, null)
            ->where('section_id=?', $sectionId)
            ->order('block_order', 1)
            ->columns('s.*,b.*')
            ->all();

        // prepare item data
        foreach ($allBlocks as $block) {

            if (!$block instanceof LayoutBlock) continue;

            $rows[ $block->getId() ] = array_merge($block->getBlockParams(),
                [
                    'block_id'         => $block->getId(),
                    'loc_id'           => $block->getLeafId() ? $block->getLeafId() : $block->getNodeId(),
                    'node_id'          => $block->getNodeId(),
                    'leaf_id'          => $block->getLeafId(),
                    'parent_block_id'  => $block->getParentBlockId(),
                    'support_block_id' => $block->__get('support_block_id'),
                    'block_class'      => $block->__get('block_class'),
                    'base_path'        => $block->__get('base_path'),
                    'item_path'        => $block->__get('item_path'),
                    'block_type'       => $block->__get('block_type'),
                    'sectionId'        => $block->getSectionId(),
                    'acl'              => '',
                    'locations'        => [],
                ]
            );
        }


        for ($level = $maxLevel; $level > 0; --$level) {
            foreach ($rows as $index => $row) {
                if (empty($row)) {
                    continue;
                }

                $isValid = true;
                $parent = $row['parent_block_id'];

                if ($parent == '') {
                    continue;
                }
                $nextParent = $parent;

                for ($i = 0; $i < $level && $isValid; ++$i) {
                    if ($nextParent == '') {
                        if ($i < $level - 1) {
                            $isValid = false;
                        }
                        continue;
                    }

                    if (!isset($rows[ $nextParent ])) {
                        $isValid = false;
                    } else {
                        $nextParent = $rows[ $nextParent ]['parent_block_id'];
                    }
                }
                if ($isValid && $nextParent == '' && $i == $level) {
                    $rows[ $parent ]['locations'][ $row['loc_id'] ][ $row['block_id'] ] = $row;
                    unset($rows[ $index ]);
                }
            }
        }

        $response = [];

        foreach ($rows as $index => $row) {
            if ($row['parent_block_id'] == '' && !empty($row)) {
                $response[ $row['loc_id'] ][ $row['block_id'] ] = $row;
            }
        }

        return $response;
    }

    /**
     * @param string $type   values 'container','block'
     * @param bool   $active values false, true
     *
     * @return array
     */
    public function findAvailableBlocks($type = 'block', $active = true)
    {
        $select = \App::table('layout.layout_support_block')
            ->select()
            ->order('module_name', 1);

        if ($type !== null) {
            $select->where('block_type=?', (string)$type);
        }

        if ($active !== null) {
            $select->where('module_name IN ?', \App::extensions()->getActiveModuleNames());
        }

        return $select->all();
    }

    /**
     * @param Layout $layout
     * @param array  $sectionList
     *
     * @throws \InvalidArgumentException
     */
    public function updateLayout(Layout $layout, $sectionList)
    {
        if (empty($sectionList))
            throw new \InvalidArgumentException();


        // delete old section which does not remaining.

        $this->deleteDoesNotRemainSection($layout->getId(), array_keys($sectionList));

        /**
         * check insert or edit section id list.
         */

        foreach ($sectionList as $sectionId => $sectionData) {
            $this->updateLayoutSection($layout->getId(), $sectionId, $sectionData);
        }

    }

    /**
     * Delete old section in layoutId which does not contain in excludes
     *
     * @use updateLayout
     *
     * @param $layoutId
     * @param $excludes
     *
     * @return bool
     */
    protected function deleteDoesNotRemainSection($layoutId, $excludes)
    {
        if (empty($excludes) || empty($layoutId)) return;

        $sections = \App::table('layout.layout_section')
            ->select()
            ->where('layout_id=?', (string)$layoutId)
            ->where('section_id NOT IN ?', (array)$excludes)
            ->all();

        foreach ($sections as $section) {

            if (!$section instanceof LayoutSection) continue;

            $this->deleteLayoutBlockInSection($section->getId());

            $section->delete();
        }
    }

    /**
     * @param string $sectionId
     */
    protected function deleteLayoutBlockInSection($sectionId)
    {
        \App::table('layout.layout_block')
            ->delete()
            ->where('section_id = ?', $sectionId)
            ->execute();
    }

    /**
     * @param string $layoutId
     * @param string $sectionId
     * @param array  $sectionData
     *
     * @return LayoutSection
     */
    public function updateLayoutSection($layoutId, $sectionId, $sectionData)
    {
        $section = $this->findLayoutSectionById($sectionId);

        $updateSectionData = [
            'section_order'       => $sectionData['section_order'],
            'section_active'      => 1,
            'layout_id'           => $layoutId,
            'section_type'        => 'section_type',
            'section_template'    => $sectionData['section_template'],
            'section_params_text' => '[]',
        ];

        if (!$section) {
            $insertSectionData = array_merge([
                'section_id' => $sectionData['section_id'],
            ], $updateSectionData);

            $section = $this->addLayoutSection($insertSectionData);
        }
        $section->setFromArray($updateSectionData);

        $section->save();

        $this->deleteDoesNotRemainBlocks($sectionId, $sectionData['remainBlockIdList']);

        /**
         * if not contain blocks
         */
        if (empty($sectionData['blocks']))
            return $section;

        /**
         *
         */
        foreach ($sectionData['blocks'] as $blockData)
            $this->updateLayoutBlock($section->getId(), $blockData);

        return $section;
    }

    /**
     * @param $id
     *
     * @return \Layout\Model\LayoutSection
     */
    public function findLayoutSectionById($id)
    {
        return \App::table('layout.layout_section')->findById($id);
    }

    /**
     * @param $data
     *
     * @return \Layout\Model\LayoutSection
     */
    public function addLayoutSection($data = [])
    {
        $section = new LayoutSection($data);

        $section->save();

        return $section;

    }

    /**
     * Delete old blocks in section
     *
     * @param $sectionId
     * @param $excludes
     */
    public function deleteDoesNotRemainBlocks($sectionId, $excludes)
    {
        if (empty($sectionId)) return;

        if (empty($excludes)) {
            $excludes[] = '-1';
        }

        \App::table('layout.layout_block')
            ->delete()
            ->where('section_id=?', $sectionId)
            ->where('block_id NOT IN ?', $excludes)
            ->execute();
    }

    /**
     * @param string $sectionId
     * @param array  $blockData
     *
     * @return \Layout\Model\LayoutBlock
     */
    protected function updateLayoutBlock($sectionId, $blockData)
    {
        if (empty($blockData['block_id']))
            throw new \InvalidArgumentException();

        $blockId = $blockData['block_id'];

        $updateData = [
            'section_id'       => $sectionId,
            'support_block_id' => $blockData['support_block_id'],
            'parent_block_id'  => $blockData['parent_block_id'],
            'block_order'      => $blockData['block_order'],
            'node_id'          => $blockData['node_id'],
            'leaf_id'          => $blockData['leaf_id'],
        ];

        $block = $this->findLayoutBlockById($blockId);

        if (!$block) {
            if (empty($blockData['settings'])) {
                $blockData['settings'] = [];
            }
            $updateData['block_params_text'] = json_encode((array)$blockData['settings']);

            $block = $this->addLayoutBlock($blockId, $updateData);
        }

        $block->setFromArray($updateData);
        $block->save();


        if (!empty($blockData['blocks'])) {
            foreach ($blockData['blocks'] as $subBlock) {

                // prevent issues if needed
                $subBlock['parent_block_id'] = $blockId;

                $this->updateLayoutBlock($sectionId, $subBlock);
            }
        }

        return $block;
    }

    /**
     * @param $id
     *
     * @return \Layout\Model\LayoutBlock
     */
    public function findLayoutBlockById($id)
    {
        return \App::table('layout.layout_block')->findById($id);
    }

    /**
     * @param  string $blockId
     * @param  array  $data
     *
     * @return \Layout\Model\LayoutBlock
     */
    public function addLayoutBlock($blockId, $data)
    {
        $data['block_id'] = $blockId;
        $block = new LayoutBlock($data);
        $block->save();

        return $block;
    }

    /**
     * @param string $layoutId
     *
     * @return string
     */
    public function renderLayoutForEdit($layoutId)
    {
        $layoutData = $this->loadLayoutDataForRender($layoutId);

        $response = [];

        foreach ($layoutData['sections'] as $sectionData) {
            $response[] = $this->renderSectionForEdit($sectionData);
        }

        return implode('', $response);
    }

    /**
     * @param $sectionData
     *
     * @return string
     */
    public function renderSectionForEdit($sectionData)
    {
        $response = [
            'section_id' => $sectionData['section_id'],
            'forEdit'    => 1,
        ];

        foreach ($sectionData['locations'] as $location => $blocks) {
            $html = [];
            foreach ($blocks as $blockData) {
                $html[] = $this->renderBlockForEdit($blockData);
            }
            $response[ $location ] = implode(PHP_EOL, $html);
        }

        $script = 'layout/section/section-' . $sectionData['section_template'] . '';

        return \App::viewHelper()->partial($script, $response);
    }

    /**
     * @param $blockData
     *
     * @return string
     */
    public function renderBlockForEdit($blockData)
    {
        $support = $this->findSupportBlockById($blockData['support_block_id']);

        return $support->renderForEdit($blockData);
    }

    /**
     * @param string $id
     *
     * @return \Layout\Model\LayoutSupportBlock
     */
    public function findSupportBlockById($id)
    {
        return \App::table('layout.layout_support_block')
            ->findById($id);
    }

    /**
     * @param string $masterScript
     *
     * @return string
     */
    public function render($masterScript = null)
    {
        if (null == $masterScript) {
            $masterScript = $this->getMasterScript();
        }

        return (new View($masterScript))->render();
    }

    /**
     * @return string
     */
    public function getMasterScript()
    {
        return $this->masterScript;
    }

    /**
     * @param string $masterScript
     */
    public function setMasterScript($masterScript)
    {
        $this->masterScript = $masterScript;
    }

    /**
     * @return string
     */
    public function getTemplateId()
    {
        return $this->templateId;
    }

    /**
     * @param string $templateId
     */
    public function setTemplateId($templateId)
    {
        $this->templateId = $templateId;
    }

    /**
     * @return array
     */
    public function getBlockWrappers()
    {
        return $this->blockWrappers;
    }

    /**
     * @param array $blockWrappers
     */
    public function setBlockWrappers($blockWrappers)
    {
        $this->blockWrappers = $blockWrappers;
    }

    /**
     * @param string $name
     * @param string $class
     *
     * @return LayoutService
     */
    public function addBlockWrapper($name, $class)
    {
        $this->blockWrappers[ $name ] = $class;

        // try to unset old objects
        unset($this->blockWrapperInstances[ $name ]);

        return $this;
    }

    /**
     * @param string $name
     *
     * @return BlockWrapper
     */
    public function getBlockWrapper($name)
    {

        if (!isset($this->blockWrapperInstances[ $name ])) {
            $class = null;
            if (isset($this->blockWrappers[ $name ])) {
                $class = $this->blockWrappers[ $name ];
            }


            if (!$class or !class_exists($class)) {
                $class = '\Picaso\Layout\BlockWrapperDefault';
            }

            $this->blockWrapperInstances[ $name ] = new $class;

        }

        return $this->blockWrapperInstances[ $name ];
    }

    /**
     * Get page content from page name
     */
    public function content()
    {

        $templateId = $this->getTemplateId();
        $pageName = $this->getPageName();
        $screenSize = $this->getScreenSize();

        $layoutData = \App::cache()
            ->get(['loadDataForRender', $pageName, $templateId, $screenSize], 0, function () use ($templateId, $pageName, $screenSize) {
                return $this->getLoader()->loadDataForRender($pageName, $templateId, $screenSize);
            });


        $response = [];

        foreach ($layoutData['sections'] as $sectionData) {
            $response[] = $this->renderSection($sectionData);
        }

        return implode('', $response);
    }

    /**
     * @param $class
     * @param $params
     *
     * @return string
     */
    public function renderBlockContent($class, $params)
    {
        try {

            if (!class_exists($class))
                throw new \InvalidArgumentException();

            $block = new $class($params);

            if (!$block instanceof Block)
                throw new \InvalidArgumentException();

            $block->execute();

            return $block->getContent();

        } catch (\Exception $ex) {
            if (PICASO_DEBUG) {
                echo $ex->getMessage();
            }
        }

        return '';
    }

    /**
     * @param string $pageName
     *
     * @return BlockParams
     */
    public function getContentLayoutParams($pageName = null)
    {
        return new BlockParams($this->getLayoutParams('content', $pageName));
    }

    /**
     * @param string $pageName
     *
     * @return BlockParams
     */
    public function getHeaderLayoutParams($pageName = null)
    {
        return new BlockParams($this->getLayoutParams('header', $pageName));
    }

    /**
     * @param string $pageName
     *
     * @return BlockParams
     */
    public function getFooterLayoutParams($pageName = null)
    {
        return new BlockParams($this->getLayoutParams('footer', $pageName));
    }


    /**
     * @param   string $layoutType
     * @param string   $pageName
     * @param string   $screenSize
     * @param string   $templateId
     *
     * @return array
     */
    public function getLayoutParams($layoutType, $pageName = null, $screenSize = null, $templateId = null)
    {

        if (!$pageName)
            $pageName = $this->getPageName();

        if (!$screenSize)
            $screenSize = $this->getScreenSize();

        if (!$templateId)
            $templateId = $this->getTemplateId();

        return \App::cache()->get(['layoutParams', $templateId, $pageName, $screenSize, $layoutType],
            0, function () use ($templateId, $pageName, $screenSize, $layoutType) {
                return $this->_getLayoutParams($templateId, $pageName, $screenSize, $layoutType);
            });
    }

    /**
     * @param $templateId
     * @param $pageName
     * @param $screenSize
     * @param $layoutType
     *
     * @return array
     */
    public function _getLayoutParams($templateId, $pageName, $screenSize, $layoutType)
    {
        $data = $this->_getLayoutParamsDetail($templateId, $pageName, $screenSize, $layoutType);

        $itemPath = '';
        $basePath = '';


        if ('header' == $layoutType)
            $basePath = 'base/layout/block/site-header';

        if ('footer' == $layoutType)
            $basePath = 'base/layout/block/site-footer';


        if ($layoutType == 'content') {
            $page = $this->findPageByName($pageName);

            if (!$page)
                throw new \InvalidArgumentException();

            $basePath = $page->getBasePath();
            $itemPath = $page->getItemPath();
        }

        $data['base_path'] = $basePath;
        $data['item_path'] = $itemPath;

        return $data;

    }

    /**
     * @param $templateId
     * @param $pageName
     * @param $screenSize
     * @param $layoutType
     *
     * @return array
     */
    public function _getLayoutParamsDetail($templateId, $pageName, $screenSize, $layoutType)
    {

        $pageIdList = [];

        if (in_array($layoutType, ['header', 'footer'])) {
            $pageIdList = $this->getListAncestorsPageId($pageName);
        } else {
            $page = $this->findLayoutPageByName($pageName);

            if ($page) {
                $pageIdList[] = $page->getId();
            } else {
                $pageIdList[] = $this->getRootPage()->getId();
            }

        }

        $templateIdList = $this->getListAncestorsTemplateId($templateId);

        $select = \App::table('layout.layout_setting')
            ->select()
            ->where('layout_type=?', $layoutType)
            ->where('page_id IN ?', $pageIdList);

        if (!empty($templateIdList))
            $select->where('template_id IN ?', $templateIdList);

        $items = $select->toAssocs();

        $map = [];

        foreach ($items as $offset => $item) {
            $map[ $item['template_id'] ][ $item['screen_size'] ][ $item['page_id'] ] = $item['setting_params_text'];
        }

        foreach ($templateIdList as $templateId) {
            foreach ([$screenSize, self::SCREEN_DESKTOP] as $size) {
                foreach ($pageIdList as $pageId) {
                    if (empty($map[ $templateId ])) continue;
                    if (empty($map[ $templateId ][ $size ])) continue;
                    if (empty($map[ $templateId ][ $size ][ $pageId ])) continue;

                    return json_decode($map[ $templateId ][ $size ][ $pageId ], true);
                }
            }
        }

        return [];
    }

    /**
     * header and footer style
     */
    public function header()
    {
        return $this->renderBlockContent('\Layout\Block\SiteHeaderBlock', []);

    }

    /**
     * header and footer style
     */
    public function footer()
    {
        return $this->renderBlockContent('\Layout\Block\SiteFooterBlock', []);
    }

    /**
     * @return string
     */
    public function getPageName()
    {
        return $this->pageName;
    }

    /**
     * @param string $pageName
     *
     * @return LayoutService
     */
    public function setPageName($pageName)
    {
        $this->pageName = $pageName;

        return $this;
    }


    /**
     * @return string
     */
    public function getScreenSize()
    {
        if (!$this->screenSize) {

            if (\App::request()->isTablet()) {
                $this->screenSize = self::SCREEN_DESKTOP;
            } else if (\App::request()->isMobile()) {
                $this->screenSize = self::SCREEN_MOBILE;
            } else {
                $this->screenSize = self::SCREEN_DESKTOP;
            }

        }

        return $this->screenSize;
    }

    /**
     * @param string $screenSize
     */
    public function setScreenSize($screenSize)
    {
        $this->screenSize = $screenSize;
    }

    /**
     * @return LayoutLoaderInterface
     */
    public function getLoader()
    {
        if (null == $this->loader) {
            $this->loader = $this;
        }

        return $this->loader;
    }

    /**
     * @param LayoutLoaderInterface $loader
     */
    public function setLoader($loader)
    {
        $this->loader = $loader;
    }

    /**
     * render section
     *
     * @param array $sectionData
     *
     * @return string
     */
    public function renderSection($sectionData = [])
    {
        $responseData = [];

        foreach ($sectionData['locations'] as $location => $blocks) {
            $html = [];
            foreach ($blocks as $blockData) {
                $html[] = $this->renderBlock($blockData['block_class'], $blockData);
            }
            $responseData[ $location ] = implode(PHP_EOL, $html);
        }

        $script = 'layout/section/section-' . $sectionData['section_template'];


        return \App::viewHelper()->partial($script, $responseData);
    }

    /**
     * Render a block
     *
     * @param string $class
     * @param array  $params
     *
     * @return string
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function renderBlock($class, $params = [])
    {
        try {

            if (!class_exists($class))
                throw new \InvalidArgumentException();

            $block = new $class($params);

            if (!$block instanceof Block)
                throw new \InvalidArgumentException();

            $block->execute();

            return $block->render();

        } catch (\Exception $ex) {
            if (PICASO_DEBUG) {
                echo $ex->getMessage();
            }
        }

        return '';
    }

    /**
     * @param array $moduleList
     *
     * @return array
     */
    public function getListSupportBlockByModuleName($moduleList = [])
    {
        return \App::table('layout.layout_support_block')
            ->select()
            ->where('module_name IN ?', $moduleList)
            ->toAssocs();
    }

    /**
     * @param array $moduleList
     *
     * @return array
     */
    public function getListPageByModuleName($moduleList = [])
    {
        return \App::table('layout.layout_page')
            ->select()
            ->where('module_name IN ?', $moduleList)
            ->toAssocs();
    }

    /**
     * @param $moduleList
     *
     * @return array
     */
    public function exportLayoutDataByModuleName($moduleList)
    {
        $select = \App::table('layout')
            ->select('layout')
            ->join(':layout_page', 'page', 'page.page_id=layout.page_id', null, null)
            ->where('layout.template_id=?', 'default')
            ->where('page.module_name IN ?', $moduleList)
            ->columns('layout.*,page.page_name');

        $result = [];

        // decorate data
        foreach ($select->toAssocs() as $item) {
            $result[] = [
                'page_name'   => $item['page_name'],
                'screen_size' => $item['screen_size'],
                'template_id' => $item['template_id'],
                'listSection' => $this->_exportSectionListByLayoutId($item['layout_id']),
            ];
        }

        return $result;
    }

    /**
     * @param $layoutId
     *
     * @return array
     */
    public function _exportSectionListByLayoutId($layoutId)
    {
        $select = \App::table('layout.layout_section')
            ->select()
            ->where('layout_id=?', $layoutId);

        $result = [];

        foreach ($select->toAssocs() as $item) {

            $temp = $item;

            unset($temp['layout_id']);
            $temp['listBlock'] = $this->_exportBlockListBySectionId($item['section_id']);
            $result[] = $temp;
        }

        return $result;
    }

    public function _exportBlockListBySectionId($sectionId)
    {

        $select = \App::table('layout.layout_block')
            ->select('block')
            ->join(':layout_support_block', 'support', 'support.support_block_id=block.support_block_id', null, null)
            ->where('block.section_id=?', $sectionId)
            ->columns('block.*, support.block_class');

        $result = [];

        foreach ($select->toAssocs() as $item) {
            $result[] = $item;
        }

        return $result;

    }

    public function importLayoutData($data)
    {
        foreach ($data as $row) {

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
                ->where('template_id=?', $row['template_id'])
                ->one();

            if ($layout)
                continue;

            $layout = new Layout([
                'screen_size' => $row['screen_size'],
                'page_id'     => $page->getId(),
                'template_id' => $row['template_id'],
                'is_active'   => 1,
            ]);

            $layout->save();

            foreach ($row['listSection'] as $sectionData) {
                $sectionData['layout_id'] = $layout->getId();

                \App::table('layout.layout_section')
                    ->insertIgnore($sectionData);

                foreach ($sectionData['listBlock'] as $blockData) {
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
     * @return \Layout\Service\ThemeService
     */
    public function theme()
    {
        return \App::service('layout.theme');
    }
}