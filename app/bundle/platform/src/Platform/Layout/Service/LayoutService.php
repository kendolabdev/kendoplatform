<?php

namespace Platform\Layout\Service;

use Kendo\Html\Form;
use Kendo\Kernel\KernelService;
use Platform\Layout\Model\Layout;
use Platform\Layout\Model\LayoutBlock;
use Platform\Layout\Model\LayoutSection;
use Platform\Layout\Model\LayoutSetting;
use Platform\Layout\Model\LayoutTheme;

use Kendo\Layout\BlockController;
use Kendo\Layout\BlockParams;
use Kendo\Layout\Decorator;
use Kendo\Layout\LayoutLoaderInterface;
use Kendo\Layout\Manager;
use Kendo\Layout\Navigation;

/**
 * Class Platform\LayoutService
 *
 * @package Core\Service
 */
class LayoutService extends KernelService implements LayoutLoaderInterface, Manager
{
    /**
     * Root page name to search
     */
    const PAGE_ROOT = 'platform_core_default';

    /**
     * Default template id
     */
    const DEFAULT_THEME_ID = 'default';

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
     * @var \Kendo\Layout\LayoutLoaderInterface
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
    protected $blockDecorators = [
        'none'    => '\Kendo\Layout\NoneDecorator',
        'default' => '\Kendo\Layout\DefaultDecorator',
        'panel'   => '\Kendo\Layout\PanelDecorator',
        'unit'    => '\Kendo\Layout\UnitDecorator',
        'alert'   => '\Kendo\Layout\AlertDecorator',
        'widget'  => '\Kendo\Layout\WidgetDecorator',
        'callout' => '\Kendo\Layout\CalloutDecorator',
    ];

    /**
     * @var array
     */
    protected $blockDecoratorInstances = [];

    /**
     * @var \Kendo\Layout\Navigation
     */
    protected $primaryNavigation;

    /**
     * @var \Kendo\Layout\Navigation
     */
    protected $secondaryNavigation;

    /**
     * @var string
     */
    protected $pageTitle;

    /**
     * @var array
     */
    protected $breadcrumbs = [];

    /**
     * @var array
     */
    protected $pageButtons = [];

    /**
     * @var string
     */
    protected $pageNote = '';

    /**
     * @var \Kendo\Html\Form
     */
    protected $pageFilter;

    /**
     * LayoutService constructor.
     */
    public function __construct()
    {
        $themeId = null;
        if (!empty($_COOKIE['themeId'])) {
            $themeId = $_COOKIE['themeId'];
        }
        $this->setThemeId($themeId);
    }

    /**
     * @return \Kendo\Html\Form
     */
    public function getPageFilter()
    {
        return $this->pageFilter;
    }

    /**
     * @param \Kendo\Html\Form $pageFilter
     *
     * @return \Platform\Layout\Service\LayoutService
     */
    public function setPageFilter(Form $pageFilter)
    {
        $this->pageFilter = $pageFilter;

        return $this;
    }

    /**
     * @return string
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    /**
     * @param string $pageTitle
     * @param bool   $translated
     *
     * @return \Platform\Layout\Service\LayoutService
     */
    public function setPageTitle($pageTitle, $translated = false)
    {
        $this->pageTitle = $translated ? $pageTitle : app()->text($pageTitle);

        return $this;
    }

    /**
     * @return string
     */
    public function getPageNote()
    {
        return $this->pageNote;
    }

    /**
     * @param string $pageNote
     *
     * @return \Platform\Layout\Service\LayoutService
     */
    public function setPageNote($pageNote)
    {
        $this->pageNote = $pageNote;

        return $this;
    }


    /**
     * @return array
     */
    public function getBreadcrumbs()
    {
        return $this->breadcrumbs;
    }

    /**
     * @param array $breadcrumbs
     *
     * @return \Platform\Layout\Service\LayoutService
     */
    public function setBreadcrumbs($breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;

        return $this;
    }

    /**
     * @return array
     */
    public function getPageButtons()
    {
        return $this->pageButtons;
    }

    /**
     * @param array $pageButtons
     *
     * @return \Platform\Layout\Service\LayoutService
     */
    public function setPageButtons($pageButtons)
    {
        $this->pageButtons = $pageButtons;

        return $this;
    }


    /**
     * @param $themeId
     *
     * @return array
     */
    public function getThemeData($themeId)
    {
        return app()->cacheService()
            ->get(['layout', 'getThemeData', $themeId], 0, function () use ($themeId) {
                return $this->getThemeDataFromRepository($themeId);
            });
    }

    /**
     * @param $themeId
     *
     * @return array
     */
    public function getThemeDataFromRepository($themeId)
    {
        $theme = $this->findThemeById($themeId);

        if (!$theme)
            $theme = $this->findDefaultTheme();

        return [
            'theme_id'           => $theme->getId(),
            'view_paths'         => $theme->getViewFinderPaths(),
        ];
    }

    /**
     * @return \Platform\Layout\Model\LayoutTheme
     */
    public function findDefaultTheme()
    {
        $theme = app()->table('platform_layout_theme')
            ->select()
            ->where('is_default=?', 1)
            ->one();

        if (!$theme)
            $theme = app()->table('platform_layout_theme')
                ->select()
                ->where('theme_id=?', 'default')
                ->one();

        return $theme;
    }

    /**
     * @param $themeId
     *
     * @return \Platform\Layout\Model\LayoutTheme
     */
    public function findThemeById($themeId)
    {
        return app()->table('platform_layout_theme')
            ->findById((string)$themeId);
    }

    /**
     * @return \Kendo\Layout\Navigation
     */
    public function getPrimaryNavigation()
    {
        if (null == $this->primaryNavigation) {
            $this->primaryNavigation = new Navigation();
        }

        return $this->primaryNavigation;
    }

    /**
     * @param \Kendo\Layout\Navigation $primaryNavigation
     */
    public function setPrimaryNavigation($primaryNavigation)
    {
        $this->primaryNavigation = $primaryNavigation;
    }

    /**
     * @return \Kendo\Layout\Navigation
     */
    public function getSecondaryNavigation()
    {
        if (null == $this->secondaryNavigation) {
            $this->secondaryNavigation = new Navigation();
        }

        return $this->secondaryNavigation;
    }

    /**
     * @param \Kendo\Layout\Navigation $secondaryNavigation
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
     * @return \Platform\Layout\Service\LayoutService
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
     * @return \Platform\Layout\Service\LayoutService
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

        $themeData = $this->getThemeData($themeId);

        $this->themeId = $themeData['theme_id'];

        app()->viewFinder()
            ->setPaths($themeData['view_paths']);
    }

    /**
     * @return \Platform\Layout\Model\LayoutTheme
     */
    public function getEditingTheme()
    {
        $theme = app()->table('platform_layout_theme')
            ->select()
            ->where('is_editing=?', 1)
            ->one();

        if (empty($theme))
            $theme = app()->table('platform_layout_theme')
                ->select()
                ->one();

        return $theme;
    }


    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadAdminThemePaging($query = [], $page = 1, $limit = 10)
    {
        $select = app()->table('platform_layout_theme')
            ->select()
            ->where('theme_id <> ?', 'admin');

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
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadAdminLayoutPagePaging($params = [], $page = 1, $limit = 10)
    {
        $select = app()->table('platform_layout_page')
            ->select()
            ->where('is_admin=?', 0)
            ->order('module_name, page_name', 1);

        if (!empty($params['module'])) {
            $select->where('module_name IN ?', explode(',', $params['module']));
        } else {
            $select->where('module_name IN ?', app()->packages()->getActiveModules());
        }

        return $select->paging($page, $limit);
    }

    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadAdminTemplatePaging($query = [], $page = 1, $limit = 10)
    {
        $select = app()->table('platform_layout_template')
            ->select();

        if (!empty($query)) {
            // do filter there
        }

        return $select->paging($page, $limit);
    }


    /**
     * @return string
     */
    public function getEditingThemeId()
    {
        return app()->layouts()
            ->getEditingTheme()
            ->getId();
    }


    /**
     * @param array $params
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadThemePaging($params = [], $page = 1, $limit = 10)
    {
        $select = app()->table('platform_layout_theme')
            ->select();

        if (!empty($params)) {
            // do filter there
        }

        return $select->paging($page, $limit);

    }

    /**
     * @param string $blockId
     *
     * @return \Platform\Layout\Model\LayoutBlock
     */
    public function findBlockById($blockId)
    {

        return app()->table('platform_layout_block')
            ->findById((string)$blockId);
    }

    /**
     * @param $layoutId
     *
     * @return \Platform\Layout\Model\Layout
     */
    public function findLayoutById($layoutId)
    {
        return app()->table('platform_layout')
            ->findById($layoutId);
    }

    /**
     * @param $pageName
     * @param $screenSize
     * @param $themeId
     *
     * @return \Platform\Layout\Model\Layout
     * @throws \Exception
     */
    public function findLayout($pageName, $screenSize, $themeId)
    {
        $pageId = $this->findPageIdByPageName($pageName);

        return app()->table('platform_layout')
            ->select('layout')
            ->where('page_id=?', $pageId)
            ->where('screen_size=?', $screenSize)
            ->where('theme_id=?', $themeId)
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
     * @return \Platform\Layout\Model\LayoutPage
     */
    public function findPageByName($pageName)
    {
        return app()->table('platform_layout_page')
            ->select('t')
            ->where('page_name=?', $pageName)
            ->one();

    }

    /**
     * @param string $pageName
     * @param string $themeId
     * @param string $screenSize
     * @param array  $params
     *
     * @return \Platform\Layout\Model\Layout
     */
    public function createLayout($pageName, $themeId, $screenSize, $params = [])
    {
        $pageId = $this->findPageIdByPageName($pageName);

        $data = array_merge([
            'page_id'     => $pageId,
            'screen_size' => $screenSize,
            'theme_id'    => $themeId,
            'is_active'   => 1,
        ], $params);

        $layout = app()->table('platform_layout')
            ->fetchNew($data);

        $layout->save();

        return $layout;

    }


    /**
     * @param  string $type
     *
     * @return array
     */
    public function loadSupportSections($type = null)
    {
        $select = app()->table('platform_layout_support_section')
            ->select()
            ->order('support_section_order', 1);

        if (!empty($type)) {
            if (!is_array($type)) {
                $type = [$type];
            }
            $select->where('support_section_type IN ?', $type);
        }


        return $select->all();
    }

    /**
     * @param string $pageName
     * @param string $themeId
     * @param string $screenSize
     *
     * @return array [layoutText: string]
     */
    public function loadDataForRender($pageName, $themeId, $screenSize)
    {
        $layoutId = $this->findClosestLayoutId($pageName, $screenSize, $themeId);

        return $this->loadLayoutDataForRender($layoutId);
    }


    /**
     * Find template id to match layout
     *
     * @param string $pageName
     * @param string $screenSize
     * @param string $preferThemeId
     *
     * @return int
     */
    public function findClosestLayoutId($pageName, $screenSize, $preferThemeId)
    {


        $pageIdList = $this->getListAncestorsPageId($pageName);
        $themeIdList = $this->getListAncestorsThemeId($preferThemeId);

        $select = app()->table('platform_layout')
            ->select()
            ->where('page_id IN ?', $pageIdList);


        if (!empty($themeIdList))
            $select->where('theme_id IN ?', $themeIdList);


        $items = $select->toAssocs();

        $map = [];

        // prefer theme then page?
        foreach ($items as $offset => $item) {
            $map[ $item['theme_id'] ][ $item['screen_size'] ][ $item['page_id'] ] = $item['layout_id'];
        }

        foreach ($themeIdList as $themeId) {
            foreach ([$screenSize, self::SCREEN_DESKTOP] as $size) {
                foreach ($pageIdList as $pageId) {
                    if (empty($map[ $themeId ])) continue;
                    if (empty($map[ $themeId ][ $size ])) continue;
                    if (empty($map[ $themeId ][ $size ][ $pageId ])) continue;

                    return $map[ $themeId ][ $size ][ $pageId ];
                }
            }
        }

        return null;
    }

    /**
     * @param $pageName
     * @param $screenSize
     * @param $preferThemeId
     *
     * @return \Platform\Layout\Model\Layout|null
     */
    public function findClosestLayout($pageName, $screenSize, $preferThemeId)
    {
        $layoutId = $this->findClosestLayoutId($pageName, $screenSize, $preferThemeId);
        if ($layoutId)
            return $this->findLayoutById($layoutId);

        return null;
    }

    /**
     * @param \Platform\Layout\Model\Layout $layout
     * @param string                        $forThemeId
     *
     * @return \Platform\Layout\Model\Layout
     */
    public function cloneLayout($layout, $forThemeId)
    {
        $cloneLayout = app()->table('platform_layout')
            ->select()
            ->where('theme_id=?', $forThemeId)
            ->where('screen_size=?', $layout->getScreenSize())
            ->where('page_id=?', $layout->getPageId())
            ->one();

        if (!empty($cloneLayout))
            return $cloneLayout;

        $cloneLayout = new Layout([
            'page_id'     => $layout->getPageId(),
            'theme_id'    => $forThemeId,
            'screen_size' => $layout->getScreenSize(),
            'is_active'   => 1,
        ]);

        $cloneLayout->save();

        $sections = app()->table('platform_layout_section')
            ->select()
            ->where('layout_id=?', $layout->getId())
            ->all();

        foreach ($sections as $section) {
            if (!$section instanceof LayoutSection) continue;

            $sectionData = $section->toArray();

            // Update section id
            $sectionData['section_id'] = $this->_generateNewId();
            $sectionData['layout_id'] = $cloneLayout->getId();

            $cloneSection = new LayoutSection($sectionData);
            $cloneSection->save();

            /// checker about block
            $blocks = app()->table('platform_layout_block')
                ->select()
                ->where('section_id=?', $section->getId())
                ->all();

            $mapBlockId = [];
            // build map blocks id
            foreach ($blocks as $block) {
                if (!$block instanceof LayoutBlock) continue;

                $mapBlockId[ $block->getId() ] = $this->_generateNewId();
            }

            foreach ($blocks as $block) {
                if (!$block instanceof LayoutBlock) continue;
                $blockData = $block->toArray();
                $blockData['section_id'] = $cloneSection->getId();
                $blockData['block_id'] = $mapBlockId[ $block->getId() ];
                if (!empty($blockData['parent_block_id']))
                    $blockData['parent_block_id'] = $mapBlockId[ $blockData['parent_block_id'] ];

                $cloneBlock = new LayoutBlock($blockData);
                $cloneBlock->save();
            }
        }

        return $cloneLayout;
    }

    /**
     * @return string
     */
    public function _generateNewId()
    {
        $seek = 'qwertyuiopasdfghjklzxcvbnm1234567890';
        $max = strlen($seek) - 1;
        $result = '';
        for ($i = 0; $i < 24; ++$i) {
            $result .= substr($seek, mt_rand(0, $max), 1);
        }

        return $result;
    }


    /**
     * @param $templateId
     *
     * @return \Platform\Layout\Model\LayoutTemplate
     */
    public function findTemplateById($templateId)
    {
        return app()->table('platform_layout_template')
            ->findById($templateId);
    }

    /**
     * @param $pageName
     *
     * @return \Platform\Layout\Model\LayoutPage
     */
    public function findLayoutPageByName($pageName)
    {
        return app()->table('platform_layout_page')
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
        $file = KENDO_TEMPLATE_DIR . '/' . $templateId . '/setting.json';

        if (!file_exists($file))
            throw new \InvalidArgumentException("Can not find template settings.");

        return json_decode(file_get_contents($file), true);
    }

    /**
     * Get template block settings.
     * This method is used to edit configure layout for main action content.
     *
     * @param string $themeId
     * @param string $layoutType
     * @param string $path
     *
     * @return array
     */
    public function getTemplateBlockRenderSettings($themeId, $layoutType, $path)
    {
        /**
         * Get page for content but there no update.
         */

        if ('header' == $layoutType)
            $path = 'layout/header';


        if ('footer' == $layoutType)
            $path = 'layout/footer';

        return $this->_getTemplateBlockRenderSettings($path, $themeId);
    }

    /**
     * Get template block settings.
     * This method is used to edit configure layout for main action content.
     * Support get from theme but there no item from now
     *
     * @param string $path
     * @param string $themeId
     *
     * @return array
     */
    public function getTemplateSupportBlockSettings($path, $themeId)
    {
        $theme = app()->layouts()
            ->findThemeById($themeId);

        $paths = $theme->getViewFinderPaths();
        $directory = KENDO_TEMPLATE_DIR . '/default/' . $path;

        foreach ($paths as $dir) {
            if (is_dir($path)) {
                $directory = $dir;
                break;
            }
        }

        $iterator = new \DirectoryIterator ($directory);

        $files = [];


        foreach ($iterator as $info) {

            if (!$info->isFile()) continue;

            $baseName = $info->getBasename('.tpl');
            $fileName = $info->__toString();

            if (strpos($baseName, 'admin') !== false) continue;
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
        $file = KENDO_TEMPLATE_DIR . '/' . $templateId . '/' . $path . '/' . $script . '.json';

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
     * @param string $themeId
     *
     * @return array
     */
    public function _getTemplateBlockRenderSettings($path, $themeId = 'default')
    {

        $theme = app()->layouts()
            ->findThemeById($themeId);

        $paths = $theme->getViewFinderPaths();
        $directory = KENDO_TEMPLATE_DIR . '/default/' . $path;

        foreach ($paths as $dir) {
            if (is_dir($path)) {
                $directory = $dir;
                break;
            }
        }

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

            if (strpos($baseName, 'admin') !== false) continue;

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
     * @param $themeId
     *
     * @return \Platform\Layout\Model\LayoutSetting
     */
    public function getLayoutSettings($layoutType, $pageName, $screenSize, $themeId)
    {
        if (!$themeId)
            $themeId = self::DEFAULT_THEME_ID;

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

        $select = app()->table('platform_layout_setting')
            ->select()
            ->where('screen_size=?', $screenSize)
            ->where('layout_type=?', $layoutType)
            ->where('theme_id=?', $themeId)
            ->where('page_id=?', $page->getId());

        $setting = $select->one();

        if (!$setting) {
            $setting = new LayoutSetting([
                'theme_id'            => $themeId,
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
        return app()->table('platform_layout_page')
            ->select('t')
            ->where('page_name=?', $pageName)
            ->field('parent_page_name');
    }

    /**
     * @param string $themeId
     *
     * @return array
     */
    public function _getListAncestorsThemeId($themeId)
    {
        $theme = $this->findThemeById($themeId);

        $result = [$themeId];

        if ($theme->getParentThemeId()) {
            $result[] = $theme->getParentThemeId();
        }

        if ($theme->getSuperThemeId()) {
            $result[] = $theme->getSuperThemeId();
        }

        return $result;
    }

    /**
     * @param  string $themeId
     *
     * @return array
     */
    public function getListAncestorsThemeId($themeId)
    {

        return app()->cacheService()
            ->get(['layout', 'getListAncestorsThemeId', $themeId], 0, function () use ($themeId) {
                return $this->_getListAncestorsThemeId($themeId);
            });

    }

    /**
     * @param $templateId
     *
     * @return array
     */
    public function _getListAncestorsTemplateId($templateId)
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
     * @param $templateId
     *
     * @return array
     */
    public function getListAncestorsTemplateId($templateId)
    {

        return app()->cacheService()
            ->get(['layout', 'getListAncestorsTemplateId', $templateId], 0, function () use ($templateId) {
                return $this->_getListAncestorsTemplateId($templateId);
            });
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
     * @return \Platform\Layout\Model\LayoutPage
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

            $sectionTemplate = $section->getSectionTemplate();

            $sectionId = $section->getId();
            $response['sections'][ $sectionId ] = [
                'locations'        => $this->loadSectionData($sectionId),
                'section_template' => $sectionTemplate,
                'section_id'       => $sectionId,
                'section_type'     => $section->getSectionType(),
                'container_type'   => $section->getContainerType(),
            ];
        }

        return $response;
    }

    /**
     * @param int $layoutId
     * @param int $onlyActiveValue
     *
     * @return array
     */
    public function loadSectionsByLayoutId($layoutId, $onlyActiveValue = null)
    {
        $select = app()->table('platform_layout_section')
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

        $supportBlockTable = app()->table('platform_layout_support_block')->getName();


        $allBlocks = app()->table('platform_layout_block')
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
        $select = app()->table('platform_layout_support_block')
            ->select()
            ->order('module_name', 1);

        if ($type !== null) {
            $select->where('block_type=?', (string)$type);
        }

        if ($active !== null) {
            $select->where('module_name IN ?', app()->packages()->getActiveModules());
        }

        return $select->all();
    }

    /**
     * @param \Platform\Layout\Model\Layout $layout
     * @param array                         $sectionList
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

        $sections = app()->table('platform_layout_section')
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
        app()->table('platform_layout_block')
            ->delete()
            ->where('section_id = ?', $sectionId)
            ->execute();
    }

    /**
     * @param string $layoutId
     * @param string $sectionId
     * @param array  $sectionData
     *
     * @return \Platform\Layout\Model\LayoutSection
     */
    public function updateLayoutSection($layoutId, $sectionId, $sectionData)
    {
        $section = $this->findLayoutSectionById($sectionId);

        $updateSectionData = [
            'section_order'       => $sectionData['section_order'],
            'section_active'      => 1,
            'layout_id'           => $layoutId,
            'section_type'        => 'main',
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
     * @return \Platform\Layout\Model\LayoutSection
     */
    public function findLayoutSectionById($id)
    {
        return app()->table('platform_layout_section')->findById($id);
    }

    /**
     * @param $data
     *
     * @return \Platform\Layout\Model\LayoutSection
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

        app()->table('platform_layout_block')
            ->delete()
            ->where('section_id=?', $sectionId)
            ->where('block_id NOT IN ?', $excludes)
            ->execute();
    }

    /**
     * @param string $sectionId
     * @param array  $blockData
     *
     * @return \Platform\Layout\Model\LayoutBlock
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
     * @return \Platform\Layout\Model\LayoutBlock
     */
    public function findLayoutBlockById($id)
    {
        return app()->table('platform_layout_block')->findById($id);
    }

    /**
     * @param  string $blockId
     * @param  array  $data
     *
     * @return \Platform\Layout\Model\LayoutBlock
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
     * @param array  $sectionData
     * @param string $sectionTemplate
     *
     * @return string
     */
    public function renderSectionForEdit($sectionData, $sectionTemplate = null)
    {
        $response = [
            'section_id' => $sectionData['section_id'],
            'forEdit'    => 1,
        ];

        if (empty($sectionTemplate)) {
            $sectionTemplate = $sectionData['section_template'];
        }

        foreach ($sectionData['locations'] as $location => $blocks) {
            $html = [];
            foreach ($blocks as $blockData) {
                $html[] = $this->renderBlockForEdit($blockData);
            }
            $response[ $location ] = implode(PHP_EOL, $html);
        }

        $script = 'layout/section/' . $sectionTemplate . '';

        return app()->viewHelper()->partial($script, $response);
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
     * @return \Platform\Layout\Model\LayoutSupportBlock
     */
    public function findSupportBlockById($id)
    {
        return app()->table('platform_layout_support_block')
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

        $request = app()->requester();

        return app()->viewHelper()->partial($masterScript, [
                'fullControllerName' => $request->getFullControllerName()
            ]
        );
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
    public function getBlockDecorators()
    {
        return $this->blockDecorators;
    }

    /**
     * @param array $blockDecorators
     */
    public function setBlockDecorators($blockDecorators)
    {
        $this->blockDecorators = $blockDecorators;
    }

    /**
     * @param string $name
     * @param string $class
     *
     * @return \Platform\Layout\Service\LayoutService
     */
    public function addBlockDecorator($name, $class)
    {
        $this->blockDecorators[ $name ] = $class;

        // try to unset old objects
        unset($this->blockDecoratorInstances[ $name ]);

        return $this;
    }

    /**
     * @param string $name
     *
     * @return Decorator
     */
    public function getBlockDecorator($name)
    {

        if (!isset($this->blockDecoratorInstances[ $name ])) {
            $class = null;
            if (isset($this->blockDecorators[ $name ])) {
                $class = $this->blockDecorators[ $name ];
            }


            if (!$class or !class_exists($class)) {
                $class = '\Kendo\Layout\DefaultDecorator';
            }

            $this->blockDecoratorInstances[ $name ] = new $class;

        }

        return $this->blockDecoratorInstances[ $name ];
    }

    /**
     * Get page content from page name
     */
    public function content()
    {

        $themeId = $this->getThemeId();
        $pageName = $this->getPageName();
        $screenSize = $this->getScreenSize();

        $layoutData = app()->cacheService()
            ->get(['loadDataForRender', $pageName, $themeId, $screenSize], 0, function () use ($themeId, $pageName, $screenSize) {
                return $this->getLoader()->loadDataForRender($pageName, $themeId, $screenSize);
            });
        $response = [];

        foreach ($layoutData['sections'] as $sectionData) {
            $content = $this->renderSection($sectionData);
            $sectionId = $sectionData['section_id'];
            $sectionType = $sectionData['section_type'];
            $containerType = $sectionData['container_type'];

            if (empty($content)) continue;

            $response[] = '<section class="' . $sectionType . '"><div class="' . $containerType . '" id="' . $sectionId . '">' . $content . '</div></section>';

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

            if (!$block instanceof BlockController)
                throw new \InvalidArgumentException();

            $block->execute();

            return $block->getContent();

        } catch (\Exception $ex) {
            if (KENDO_DEBUG) {
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

        return app()->cacheService()->get(['layoutParams', $templateId, $pageName, $screenSize, $layoutType],
            0, function () use ($templateId, $pageName, $screenSize, $layoutType) {
                return $this->_getLayoutParams($pageName, $screenSize, $layoutType);
            });
    }

    /**
     * @param $pageName
     * @param $screenSize
     * @param $layoutType
     *
     * @return array
     */
    public function _getLayoutParams($pageName, $screenSize, $layoutType)
    {
        $data = $this->_getLayoutParamsDetail($pageName, $screenSize, $layoutType);


        $itemPath = '';
        $basePath = '';

        if ('header' == $layoutType) {
            $basePath = 'layout/header';
        }

        if ('footer' == $layoutType) {
            $basePath = 'layout/footer';
        }

        if ($layoutType == 'content') {

            $page = $this->findPageByName($pageName);

            if (!$page) {
                throw new \InvalidArgumentException(sprintf('Unexpected page "%s"', $pageName));
            }

            $basePath = $page->getBasePath();
            $itemPath = $page->getItemPath();
        }


        $data['base_path'] = $basePath;
        $data['item_path'] = $itemPath;

        return $data;

    }

    /**
     * @param $pageName
     * @param $screenSize
     * @param $layoutType
     *
     * @return array
     */
    public function _getLayoutParamsDetail($pageName, $screenSize, $layoutType)
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

        $themeIdList = $this->getListAncestorsThemeId($this->themeId);


        $select = app()->table('platform_layout_setting')
            ->select()
            ->where('layout_type=?', $layoutType)
            ->where('page_id IN ?', $pageIdList);


        if (!empty($themeIdList))
            $select->where('theme_id IN ?', $themeIdList);


        $items = $select->toAssocs();

        $map = [];

        foreach ($items as $offset => $item) {
            $map[ $item['theme_id'] ][ $item['screen_size'] ][ $item['page_id'] ] = $item['setting_params_text'];
        }

        foreach ($themeIdList as $themeId) {
            foreach ([$screenSize, self::SCREEN_DESKTOP] as $size) {
                foreach ($pageIdList as $pageId) {
                    if (empty($map[ $themeId ])) continue;
                    if (empty($map[ $themeId ][ $size ])) continue;
                    if (empty($map[ $themeId ][ $size ][ $pageId ])) continue;

                    return json_decode($map[ $themeId ][ $size ][ $pageId ], true);
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
        return $this->renderBlockContent('\Platform\Layout\Block\SiteHeaderBlock', []);

    }

    /**
     * header and footer style
     */
    public function footer()
    {
        return $this->renderBlockContent('\Platform\Layout\Block\SiteFooterBlock', []);
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
     * @return \Platform\Layout\Service\LayoutService
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

            if (app()->requester()->isTablet()) {
                $this->screenSize = self::SCREEN_DESKTOP;
            } else if (app()->requester()->isMobile()) {
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
     * @return \Kendo\Layout\LayoutLoaderInterface
     */
    public function getLoader()
    {
        if (null == $this->loader) {
            $this->loader = $this;
        }

        return $this->loader;
    }

    /**
     * @param \Kendo\Layout\LayoutLoaderInterface $loader
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

        $script = 'layout/section/' . $sectionData['section_template'];

        return app()->viewHelper()->partial($script, $responseData);
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

            if (!class_exists($class)) {
                throw new \InvalidArgumentException();
            }


            if (KENDO_PROFILER) {
                $profilerKey = app()->profiler()->start('layout', 'renderBlock', $class);
            }

            $block = new $class($params);

            if (!$block instanceof BlockController)
                throw new \InvalidArgumentException();

            $block->execute();

            $renderContent = $block->render();

            if (KENDO_PROFILER and !empty($profilerKey)) {
                app()->profiler()->stop($profilerKey);
            }

            return $renderContent;

        } catch (\Exception $ex) {
            if (KENDO_DEBUG) {
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
        return app()->table('platform_layout_support_block')
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
        return app()->table('platform_layout_page')
            ->select()
            ->where('module_name IN ?', $moduleList)
            ->toAssocs();
    }

    /**
     * @param array $moduleList
     * @param array $themeList
     *
     * @return array
     */
    public function exportLayoutData($moduleList = [], $themeList = [])
    {
        $select = app()->table('platform_layout')
            ->select('layout')
            ->join(':layout_page', 'page', 'page.page_id=layout.page_id', null, null)
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
        $select = app()->table('platform_layout_section')
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

        $select = app()->table('platform_layout_block')
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

            $page = app()->table('platform_layout_page')
                ->select()
                ->where('page_name=?', $row['page_name'])
                ->one();

            if (!$page)
                continue;

            $layout = app()->table('platform_layout')
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

                app()->table('platform_layout_section')
                    ->insertIgnore($sectionData);

                foreach ($sectionData['listBlock'] as $blockData) {
                    $supportBlock = app()->table('platform_layout_support_block')
                        ->select()
                        ->where('block_class=?', $blockData['block_class'])
                        ->one();

                    if (!$supportBlock)
                        continue;

                    $blockData['support_block_id'] = $supportBlock->getId();

                    app()->table('platform_layout_block')
                        ->insertIgnore($blockData);
                }
            }
        }
    }

    /**
     * @return \Platform\Layout\Service\ThemeService
     */
    public function theme()
    {
        return app()->instance()->make('platform_layout_theme');
    }

    /**
     * @return array
     */
    public function getThemeOptions()
    {
        $options = [];

        $items = app()->table('platform_layout_theme')
            ->select()
            ->where('theme_id<>?', 'admin')
            ->all();

        foreach ($items as $item) {
            if (!$item instanceof LayoutTheme) continue;

            $options[] = [
                'label' => $item->getTitle(),
                'value' => $item->getId(),
            ];
        }

        return $options;
    }

}