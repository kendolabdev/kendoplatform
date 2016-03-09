<?php
namespace Platform\Core\Service;

use Kendo\Html\Form;
use Kendo\Layout\Navigation;
use Kendo\Test\ControllerTestCase;
use Kendo\Test\TestCase;
use Platform\Layout\Model\Layout;
use Platform\Layout\Model\LayoutPage;
use Platform\Layout\Model\LayoutTheme;

/**
 * Class LayoutTest
 *
 * @package Platform\Core
 */
class LayoutTest extends ControllerTestCase
{
    public function testGeneral()
    {
        $layoutService = app()->layouts();

        $layoutService->setPageFilter(new Form());

        $this->assertInstanceOf('\Kendo\Html\Form', $layoutService->getPageFilter());

        $faker = $this->getFaker();

        $pageTitle = $faker->sentence();

        $layoutService->setPageTitle($pageTitle);

        $this->assertEquals($pageTitle, $layoutService->getPageTitle());

        $pageNote = $faker->paragraph(4);

        $layoutService->setPageNote($pageNote);

        $this->assertEquals($pageNote, $layoutService->getPageNote());

        $this->assertEmpty($layoutService->getBreadcrumbs());

        $breadcrumbs = [
            $faker->sentence(),
            $faker->sentence(),
            $faker->sentence(),
        ];

        $layoutService->setBreadcrumbs($breadcrumbs);

        $this->assertEquals($breadcrumbs, $layoutService->getBreadcrumbs());

        $this->assertEmpty($layoutService->getPageButtons());

        $pageButtons = [
            $faker->sentence(),
            $faker->sentence(),
            $faker->sentence(),
        ];

        $layoutService->setPageButtons($pageButtons);

        $this->assertEquals($pageButtons, $layoutService->getPageButtons());

        $defaultTheme = $layoutService->findDefaultTheme();

        $this->assertTrue($defaultTheme->isDefault() == 1);

        $editingTheme = $layoutService->getEditingTheme();

        $this->assertTrue($editingTheme->isEditing() == 1);

        $this->assertEquals($editingTheme->getId(), $layoutService->getEditingThemeId());

        $this->assertInstanceOf('\Kendo\Layout\Navigation', $layoutService->getPrimaryNavigation());

        $primaryNavitation = new Navigation();

        $layoutService->setPrimaryNavigation($primaryNavitation);

        $this->assertEquals($primaryNavitation, $layoutService->getPrimaryNavigation());

        $this->assertInstanceOf('\Kendo\Layout\Navigation', $layoutService->getSecondaryNavigation());

        $secondaryNavitation = new Navigation();

        $layoutService->setSecondaryNavigation($secondaryNavitation);

        $this->assertEquals($secondaryNavitation, $layoutService->getSecondaryNavigation());

        $layoutService->setupPrimaryNavigation('core_main');

        $this->assertNotNull($layoutService->getPrimaryNavigation());

        $layoutService->setupSecondaryNavigation('core_main');

        $this->assertNotNull($layoutService->getSecondaryNavigation());

        $this->assertNotNull($layoutService->getThemeId());

        $this->assertNotNull($layoutService->loadAdminThemePaging());

        $limit = rand(1, 3);

        $paging = $layoutService->loadAdminThemePaging([], 1, $limit);

        $this->assertTrue($paging->itemCount() == $limit);


        $this->assertNotEmpty($layoutService->loadAdminLayoutPagePaging());

        $this->assertNotEmpty($layoutService->loadAdminTemplatePaging());

        $this->assertNotEmpty($layoutService->loadThemePaging());

        $this->assertNotEmpty($layoutService->loadSupportSections());

        $this->assertNotEmpty($layoutService->loadSupportSections('main'));

        $this->assertNotEmpty($layoutService->loadDataForRender('core_default', 'default', 'desktop'));

        $this->assertNotEmpty($layoutService->findClosestLayoutId('core_default', 'desktop', 'default'));

        $this->assertNotEmpty($layoutService->findClosestLayout('core_default', 'desktop', 'default'));
    }

    /**
     * @return array
     */
    public function themeIdProvider()
    {
        $themes = app()->table('platform_layout_theme')
            ->select()
            ->all();

        $result = [];

        foreach ($themes as $theme) {
            if (!$theme instanceof LayoutTheme) continue;
            $result[] = [$theme->getId()];
        }

        return $result;
    }

    /**
     * @dataProvider themeIdProvider
     *
     * @param string $themeId
     */
    public function testThemeId($themeId)
    {
        $layoutService = app()->layouts();

        $this->assertEquals($layoutService->getThemeData($themeId), $layoutService->getThemeDataFromRepository($themeId));

        $themeEntry = $layoutService->findThemeById($themeId);

        $this->assertEquals($themeEntry->getId(), $themeId);

        $layoutService->setThemeId($themeId);

        $this->assertEquals($themeId, $layoutService->getThemeId());

    }

    /**
     * @return array
     */
    public function layoutIdProvider()
    {
        $layoutList = app()->table('platform_layout')
            ->select()
            ->all();

        $result = [];
        foreach ($layoutList as $layout) {
            if (!$layout instanceof Layout) continue;
            $result[] = [$layout->getId(), $layout->getPageId(), $layout->getThemeId()];
        }

        return $result;
    }

    /**
     * @dataProvider layoutIdProvider
     *
     * @param string $layoutId
     * @param string $pageId
     * @param string $themeId
     */
    public function testLayoutId($layoutId, $pageId, $themeId)
    {
        $layoutService = app()->layouts();
        $layout = $layoutService->findLayoutById($layoutId);

        $this->assertNotEmpty($layout);

        $this->assertInstanceOf('\Platform\Layout\Model\Layout', $layout);
    }

    /**
     * @return array
     */
    public function pageNameProvider()
    {
        $pageList = app()->table('platform_layout_page')
            ->select()
            ->all();

        $result = [];
        foreach ($pageList as $page) {
            if (!$page instanceof LayoutPage) continue;
            $result[] = [$page->getId(), $page->getPageName()];
        }

        return $result;
    }

    /**
     * @dataProvider  pageNameProvider
     *
     * @param string $pageId
     * @param string $pageName
     */
    public function testPageName($pageId, $pageName)
    {
        $themeList = [
            'admin',
            'default',
            'default-dark',
        ];

        $layoutService = app()->layouts();

        foreach ($themeList as $themeId) {
            $layout = $layoutService->findLayout($pageName, 'desktop', $themeId);

            if (!empty($layout)) {
                $this->assertInstanceOf('\Platform\Layout\Model\Layout', $layout);
            }
        }

        $checkPageId = $layoutService->findPageIdByPageName($pageName);

        $this->assertEquals($pageId, $checkPageId);
    }

    public function testCreateLayout()
    {
        $layoutService = app()->layouts();

        $page = app()->table('platform_layout_page')
            ->fetchNew([
                'page_name'        => 'test_page',
                'parent_page_name' => 'core_default',
                'module_name'      => 'platform_rad',
                'item_module_name' => 'platform_rad',
                'is_admin'         => 0,
                'base_path'        => '',
                'item_path'        => '',
            ]);

        $page->save();

        $layout = $layoutService->createLayout($page->getPageName(), 'default', 'desktop', []);

        $this->assertInstanceOf('\Platform\Layout\Model\Layout', $layout);

        $layout->delete();

        $page->delete();
    }

    public function testCloneLayout()
    {
        $layoutService = app()->layouts();

        $layout = $layoutService->findClosestLayout('core_default', 'desktop', 'default');

        $this->assertInstanceOf('\Platform\Layout\Model\Layout', $layout);


        $cloneLayout = $layoutService->cloneLayout($layout, 'default-test');

        $this->assertInstanceOf('\Platform\Layout\Model\Layout', $cloneLayout);

        $cloneLayout->delete();


    }
}