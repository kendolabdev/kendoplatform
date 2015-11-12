<?php
namespace Layout\Controller\Admin;

use Layout\Form\Admin\FilterLayout;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

/**
 * Class ManageController
 *
 * @package Layout\Controller\Admin
 */
class ManageController extends AdminController
{

    /**
     *
     */
    public function actionBrowse()
    {
        $filter = new FilterLayout();

        \App::layout()
            ->setPageName('admin_simple')
            ->setPageTitle('layout.manage_layouts')
            ->setPageFilter($filter)
            ->setupSecondaryNavigation('admin', 'admin_appearance', 'layouts');

        \App::assets()
            ->setTitle(\App::text('core_layout.manage_layouts'));

        $module = $this->request->getParam('module', 'core');



        $filter->isValid(['module' => $module]);

        $page = 1;
        $limit = 100;

        $params = $filter->getData();

        $paging = \App::layout()
            ->loadAdminLayoutPagePaging($params, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'base/layout/controller/admin/manage/browse-layout',
        ]);

        $this->view->setScript($lp->script())
            ->assign([
                'filter' => $filter,
                'paging' => $paging
            ]);
    }


    /**
     *
     */
    public function actionEdit()
    {
        \App::layout()
            ->setPageName('admin_layout_editor');

        \App::assets()
            ->setTitle(\App::text('core_layout.edit_layout'));

        $pageName = $this->request->getParam('pageName', 'core_home');
        $screenSize = $this->request->getParam('screenSize', 'medium');
        $themeId = $theme = \App::layout()->getEditingThemeId();

        $layoutAttributes = [
            'pageName'   => $pageName,
            'screenSize' => $screenSize,
            'themeId'    => $themeId,
        ];


        $layoutService = \App::layout();


        /**
         * just clone themes.
         *
         */

        $layoutId = null;
        $layout = null;
        $layoutConfigText = null;
        $layoutEditHtml = '';

        $layout = $layoutService->findLayout($pageName, $screenSize, $themeId);

        if (!$layout) {
            $layout = $layoutService->findClosestLayout($pageName, $screenSize, $themeId);
            $layout = $layoutService->cloneLayout($layout, $themeId);
            // clone layout configuration.
        }

        if ($layout)
            $layoutId = $layout->getId();


        if ($layoutId)
            $layoutEditHtml = $layoutService->renderLayoutForEdit($layoutId);

        $supportContainers = $layoutService->findAvailableBlocks('container', true);

        $supportBlocks = $layoutService->findAvailableBlocks('block', true);

        $supportSections = $layoutService->loadSupportSections();


        \App::assets()
            ->requirejs()
            ->addDependency(['base/core/layout_editor']);

        $this->view->assign([
            'layout'            => $layout,
            'pageName'          => $pageName,
            'screenSize'        => $screenSize,
            'themeId'           => $themeId,
            'layoutId'          => $layoutId,
            'layoutConfigText'  => $layoutConfigText,
            'supportBlocks'     => $supportBlocks,
            'supportSections'   => $supportSections,
            'supportContainers' => $supportContainers,
            'layoutAttrs'       => $layoutAttributes,
            'layoutEditHtml'    => $layoutEditHtml,
        ]);

        $lp = new BlockParams([
            'base_path' => 'base/layout/controller/admin/manage/edit-layout',
        ]);

        $this->view->setScript($lp->script());
    }
}