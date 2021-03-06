<?php

namespace Platform\Layout\Controller\Admin\Ajax;

use Platform\Layout\Form\Admin\EditBlockAlertDecorator;
use Platform\Layout\Form\Admin\EditBlockSelectDecorator;
use Platform\Layout\Form\Admin\EditBlockPanelDecorator;
use Platform\Layout\Model\Layout;
use Platform\Layout\Form\Admin\LayoutEditContentSetting;
use Platform\Layout\Form\Admin\LayoutSelectBlockScript;
use Platform\Layout\Form\Admin\LayoutSupportBlockSetting;
use Platform\Layout\Model\LayoutSection;
use Kendo\Controller\AjaxController;

/**
 * Class Platform\LayoutController
 *
 * @package Platform\Layout\Controller\Admin\Ajax
 */
class EditorController extends AjaxController
{

    /**
     * Add section to layout editor
     */
    public function actionAddSection()
    {
        $tpl = $this->request->getParam('tpl');

        $html = $this->partial('layout/section/' . $tpl . '', [
            'forEdit' => 1,
        ]);

        $this->response = [
            'html' => $html,
        ];
    }

    /**
     * Add section to layout editor
     */
    public function actionChangeSection()
    {
        $tpl = $this->request->getParam('tpl');
        $layoutService = app()->layouts();

        $sectionId = $this->request->getParam('sectionId');
        $section = null;
        $html = null;
        $sectionData = [];

        if ($sectionId) {
            $section = app()->layouts()
                ->findLayoutSectionById($sectionId);
        }

        if ($section instanceof LayoutSection) {
            $sectionData = [
                'locations'        => $layoutService->loadSectionData($sectionId),
                'section_template' => $section->getSectionTemplate(),
                'section_id'       => $section->getId()];

            $html = $layoutService->renderSectionForEdit($sectionData, $tpl);
        } else {
            $html = $this->partial('layout/section/' . $tpl . '', [
                'forEdit' => 1,
            ]);
        }

        $this->response = [
            'html' => $html,
        ];
    }

    /**
     *
     */
    public function actionSectionOptions()
    {
        list($eid) = $this->request->getList('eid');

        $attrs = [];

        $html = $this->partial('platform/layout/partial/admin-layout-section-options', [
            'attrs' => $attrs,
            'eid'   => $eid,
        ]);

        $this->response = [
            'html' => $html,
        ];
    }

    public function actionDeleteSection()
    {
        $sectionId = $this->request->getParam('sectionId');

        $section = app()->layouts()
            ->findLayoutSectionById($sectionId);

        $section->delete();

        $this->response = [
            'message' => 'Saved changes.',
        ];
    }

    /**
     *
     */
    public function actionBlockOptions()
    {
        list($eid, $supportBlockId) = $this->request->getList('eid', 'supportBlockId');

        $isContainer = 0;

        $supportBlock = app()->layouts()->findSupportBlockById($supportBlockId);

        if ($supportBlock->getBlockType() == 'container') {
            $isContainer = 1;
        }

        $attrs = [
            'eid'            => $eid,
            'supportBlockId' => $supportBlockId,
            'isContainer'    => $isContainer,
        ];

        $html = $this->partial('platform/layout/partial/admin-layout-block-options', [
            'attrs'          => $attrs,
            'eid'            => $eid,
            'supportBlockId' => $supportBlockId,
            'isContainer'    => $isContainer,
        ]);

        $this->response = [
            'html' => $html,
        ];
    }

    public function actionEditBlockDecorator()
    {
        $layoutService = app()->layouts();

        $postDecorator = $this->request->getParam('decorator');
        $step = $this->request->getParam('step');
        $blockId = $this->request->getParam('blockId');
        $block = $layoutService->findBlockById($blockId);


        if ($step == 0) {
            $form = new EditBlockSelectDecorator();

            $form->setData(['blockId' => $blockId]);

            $html = $this->partial('platform/layout/dialog/layout/edit-block-decorator', [
                'form' => $form,
            ]);

            $this->response = [
                'html' => $html,
            ];

            return;
        }

        if ($step == 1) {

            $form = $this->getFormBlockDecorator($postDecorator);

            $form->setData([
                'decorator' => $postDecorator,
                'blockId'   => $blockId
            ]);

            $html = $this->partial('platform/layout/dialog/layout/edit-block-decorator', [
                'form' => $form,
            ]);

            $this->response = [
                'directive' => 'update',
                'html'      => $html,
            ];

            return;
        }

        if ($step == 2) {

            $form = $this->getFormBlockDecorator($postDecorator);
            $directive = 'update';

            if ($this->request->isMethod('post') && $form->isValid($_POST)) {
                $data = $form->getData();

                $block->addBlockParams(['decorator' => $postDecorator, 'decorator_params' => $data]);

                $block->save();
                $directive = 'dismiss';
            }

            $html = $this->partial('platform/layout/dialog/layout/edit-block-decorator', [
                'form' => $form,
            ]);

            $this->response = [
                'html' => $html,
            ];


            return;
        }


    }

    /**
     * @param $type
     *
     * @return \Platform\Layout\Form\Admin\BaseEditBlockDecorator
     */
    protected function getFormBlockDecorator($type)
    {
        switch ($type) {
            case 'panel':
                return new EditBlockPanelDecorator();
            case 'alert':
                return new EditBlockAlertDecorator();
        }

    }

    /**
     *
     */
    public function actionSelectContentScript()
    {
        list($pageName, $templateId, $screenSize, $layoutType)
            = $this->request->getList('pageName', 'templateId', 'screenSize', 'layoutType');
        /**
         *
         */
        if (!$templateId)
            $templateId = 'default';

        if (!$screenSize)
            $screenSize = 'desktop';

        if (!$layoutType)
            $layoutType = 'content';

        $page = app()->layouts()
            ->findPageByName($pageName);

        if (!$page)
            throw new \InvalidArgumentException("Page does not exists");

        $entry = app()->layouts()
            ->getLayoutSettings($layoutType, $pageName, $screenSize, $templateId);

        if (!$entry)
            throw new \InvalidArgumentException();

        $oldData = $entry->getLayoutSettings();

        $baseScriptList = [];
        $itemScriptList = [];


        $baseScript = !empty($oldData['base_script']) ? $oldData['base_script'] : 'view';
        $itemScript = !empty($oldData['item_script']) ? $oldData['item_script'] : 'view';


        if (in_array($layoutType, ['header', 'footer']) or null != $page->getBasePath()) {
            $baseScriptList = app()->layouts()->getTemplateBlockRenderSettings($templateId, $layoutType, $page->getBasePath());
        }

        if (!in_array($layoutType, ['header', 'footer']) and null != $page->getItemPath()) {
            $itemScriptList = app()->layouts()->getTemplateBlockRenderSettings($templateId, $layoutType, $page->getItemPath());
        }

        if (count($baseScriptList) < 1 && count($itemScriptList) < 1) {
            return $this->request->forward( null, 'open-content-setting');
        }


        $pageTitle = 'Edit Block Settings';
        $pageNote = 'Select one of layout before edit settings.';

        /**
         * supported layouts
         */

        $html = $this->partial('platform/layout/dialog/layout/select-content-script', [
            'templateId'   => $templateId,
            'pageTitle'    => $pageTitle,
            'pageNote'     => $pageNote,
            'screenSize'   => $screenSize,
            'layoutType'   => $layoutType,
            'baseSettings' => $baseScriptList,
            'itemSettings' => $itemScriptList,
            'baseScript'   => $baseScript,
            'itemScript'   => $itemScript,
            'pageName'     => $pageName]);

        $this->response = [
            'directive' => 'update',
            'html'      => $html,
        ];

        return true;
    }

    /**
     * Delete content setting for header footer, use default configuration.
     */
    public function actionDeleteContentSetting()
    {
        list($pageName, $templateId, $screenSize, $layoutType)
            = $this->request->getList('pageName', 'templateId', 'screenSize', 'layoutType');

        /**
         *
         */
        if (!$templateId)
            $templateId = 'default';

        if (!$screenSize)
            $screenSize = 'desktop';

        if (!$layoutType)
            $layoutType = 'content';

        $page = app()->layouts()
            ->findPageByName($pageName);

        if (!$page)
            throw new \InvalidArgumentException("Page does not exists");

        $entry = app()->layouts()
            ->getLayoutSettings($layoutType, $pageName, $screenSize, $templateId);

        if ($entry)
            $entry->delete();

        app()->cacheService()
            ->flush();

        $this->response = [
            'success' => 'Remove specific settings for this page.',
        ];
    }

    /**
     * Open content settings
     */
    public function actionOpenContentSetting()
    {
        list($pageName, $templateId, $screenSize, $layoutType)
            = $this->request->getList('pageName', 'templateId', 'screenSize', 'layoutType');

        /**
         *
         */
        if (!$templateId)
            $templateId = 'default';

        if (!$screenSize)
            $screenSize = 'desktop';

        if (!$layoutType)
            $layoutType = 'content';

        $page = app()->layouts()
            ->findPageByName($pageName);

        if (!$page)
            throw new \InvalidArgumentException("Page does not exists");


        $itemScriptList = [];
        $baseScriptSetting = [];

        $baseScript = $this->request->getParam('base_script', 'view');
        $itemScript = $this->request->getParam('item_script', 'view');
        $editStep = $this->request->getParam('edit_step', '');
        $theme = app()->layouts()->getEditingTheme();
        $themeId = $theme->getId();


        $form = new LayoutEditContentSetting();


        $baseScriptList = app()->layouts()
            ->getTemplateBlockRenderSettings($themeId, $layoutType, $page->getBasePath());

        if ($layoutType == 'content' and null != $page->getItemPath()) {
            $itemScriptList = app()->layouts()->getTemplateBlockRenderSettings($themeId, $layoutType, $page->getItemPath());
        }

        $pageTitle = 'Edit Block Settings';
        $pageNote = 'Select one of layout before edit settings.';

        $entry = app()->layouts()
            ->getLayoutSettings($layoutType, $pageName, $screenSize, $themeId);

        if (!$entry)
            throw new \InvalidArgumentException();


        if (!empty($baseScriptList[ $baseScript ])) {
            $baseScriptSetting = $baseScriptList[ $baseScript ];
        }

        $baseScriptSetting = array_merge([
            'label'    => 'Edit layout settings',
            'note'     => '',
            'settings' => [],
        ], $baseScriptSetting);

        $form->setTitle($baseScriptSetting['label']);
        $form->setNote($baseScriptSetting['note']);


        if (!empty($itemScriptList[ $itemScript ]) && !empty($itemScriptList[ $itemScript ])) {
            $itemScriptSetting = $itemScriptList[ $itemScript ];
        }

        /**
         * setup form with full items
         */
        if (!empty($baseScriptSetting['settings'])) {
            $form->addElements($baseScriptSetting['settings']);
        }

        if (!empty($itemScriptSetting['settings'])) {
            $form->addElements($itemScriptSetting['settings']);
        }

        if (empty($baseScriptSetting['settings']) && empty($itemScriptSetting['settings'])) {
            $form->addElement([
                'plugin' => 'static',
                'value'  => 'There no settings for this content',
            ]);
        }

        if ($editStep == '') {
            $oldData = $entry->getLayoutSettings();
            $oldData['item_script'] = $itemScript;
            $oldData['base_script'] = $baseScript;
            $form->setData($oldData);
        }

        if ($editStep == 'save_setting' && $this->request->isMethod('post') && $form->isValid($_POST)) {
            $newData = $form->getData();

            $entry->setLayoutSettings($newData);
            $entry->save();
            // update content layout with correct information

            app()->cacheService()
                ->flush();

            $this->response = [
                'directive' => 'close',
                'html'      => '',
            ];

        } else {
            /**
             * supported layouts
             */

            $html = $this->partial('platform/layout/dialog/layout/open-content-setting', [
                'form'         => $form,
                'templateId'   => $templateId,
                'pageTitle'    => $pageTitle,
                'pageNote'     => $pageNote,
                'screenSize'   => $screenSize,
                'layoutType'   => $layoutType,
                'baseSettings' => $baseScriptList,
                'itemSettings' => $itemScriptList,
                'baseScript'   => $baseScript,
                'itemScript'   => $itemScript,
                'pageName'     => $pageName]);


            $this->response = [
                'directive' => 'update',
                'html'      => $html,
            ];
        }
    }

    /**
     * Update Content Settings
     */
    public function actionUpdateContentSetting()
    {

    }

    /**
     * Select block script
     *
     * @return true
     */
    public function actionSelectBlockScript()
    {
        list($eid, $supportBlockId, $blockId) = $this->request->getList('eid', 'supportBlockId', 'blockId');
        list($pageName, $templateId, $screenSize) = $this->request->getList('pageName', 'templateId', 'screenSize');

        $supportBlock = app()->layouts()->findSupportBlockById($supportBlockId);

        /**
         * moved select block script instead
         */
        if ('\Core\Block\ActionContentBlock' == $supportBlock->getBlockClass()) {
            $this->request->setParam('layoutType', 'content');

            return $this->request->forward('Platform\Layout\Controller\Admin\Ajax\EditorController', 'select-content-script');
        }

        $basePath = $supportBlock->getBasePath();

        $supportScripts = [];
        $formScript = 'platform/layout/dialog/layout/select-block-script';
        $baseScript = 'view';
        $form = new LayoutSelectBlockScript();
        $theme = app()->layouts()->getEditingTheme();
        $themeId = $theme->getId();


        if (!empty($basePath)) {
            $supportScripts = app()->layouts()
                ->getTemplateSupportBlockSettings($basePath, $themeId);
        }

        if (empty($supportScripts)) {
            $form->addElement([
                'plugin' => 'static',
                'value'  => 'There are no settings for this block.',
            ]);
            $formScript = 'platform/layout/dialog/layout/no-block-setting';
        } else if (count($supportScripts) == 1) {
            $this->request->forward('Platform\Layout\Controller\Admin\Ajax\EditorController', 'open-block-setting');
        }

        $data = [
            'eid'            => $eid,
            'blockId'        => $blockId,
            'supportBlockId' => $supportBlockId,
            'supportScripts' => $supportScripts,
            'baseScript'     => $baseScript,
            'form'           => $form,
            'pageName'       => $pageName,
            'screenSize'     => $screenSize,
            'templateId'     => $templateId,
        ];

        $html = $this->partial($formScript, $data);

        $this->response = [
            'html' => $html,
        ];

        return true;
    }

    /**
     * Open block settings
     */
    public function actionOpenBlockSetting()
    {
        list($eid, $supportBlockId, $blockId) = $this->request->getList('eid', 'supportBlockId', 'blockId');
        list($pageName, $templateId, $screenSize) = $this->request->getList('pageName', 'templateId', 'screenSize');

        $supportBlock = app()->layouts()->findSupportBlockById($supportBlockId);

        $basePath = $supportBlock->getBasePath();

        $supportScripts = [];
        $formScript = 'platform/layout/dialog/layout/open-block-setting';
        $supportSettings = [];
        $baseScript = $this->request->getParam('base_script', 'view');
        $form = new LayoutSupportBlockSetting();
        $theme = app()->layouts()->getEditingTheme();
        $themeId = $theme->getId();

        if (!empty($basePath)) {
            $supportScripts = app()->layouts()
                ->getTemplateSupportBlockSettings($basePath, $themeId);
        }

        if (!empty($supportScripts[ $baseScript ]['settings'])) {
            $supportSettings = $supportScripts[ $baseScript ]['settings'];
        }

        if (empty($supportSettings)) {
            $form->addElement([
                'plugin' => 'static',
                'value'  => 'There are no settings for this block.',
            ]);
        } else {
            $form->addElements($supportSettings);
        }

        $blockEntry = app()->layouts()
            ->findBlockById($blockId);


        if (!$blockEntry)
            throw new \InvalidArgumentException("Could not find block, you must save layout before edit each block");


        $blockParams = $blockEntry->getBlockParams();

        $blockParams['base_script'] = $baseScript;

        $form->setData($blockParams);

        $data = [
            'eid'            => $eid,
            'blockId'        => $blockId,
            'supportBlockId' => $supportBlockId,
            'form'           => $form,
            'pageName'       => $pageName,
            'screenSize'     => $screenSize,
            'templateId'     => $templateId,
        ];

        $html = $this->partial($formScript, $data);

        $this->response = [
            'directive' => 'update',
            'html'      => $html,
        ];
    }

    /**
     * Update settings of none "Content", "Header", "Footer" Block.
     */
    public function actionUpdateBlockSetting()
    {
        list($eid, $supportBlockId, $blockId) = $this->request->getList('eid', 'supportBlockId', 'blockId');
        list($pageName, $templateId, $screenSize) = $this->request->getList('pageName', 'templateId', 'screenSize');

        $supportBlock = app()->layouts()->findSupportBlockById($supportBlockId);

        $basePath = $supportBlock->getBasePath();

        $supportScripts = [];
        $formScript = 'platform/layout/dialog/layout/open-block-setting';
        $supportSettings = [];
        $baseScript = $this->request->getParam('base_script', 'view');
        $form = new LayoutSupportBlockSetting();

        $theme = app()->layouts()->getEditingTheme();
        $themeId = $theme->getId();


        $blockEntry = app()->layouts()
            ->findBlockById($blockId);


        if (!$blockEntry)
            throw new \InvalidArgumentException("Could not find block, you must save layout before edit each block");

        if (!empty($basePath)) {
            $supportScripts = app()->layouts()
                ->getTemplateSupportBlockSettings($basePath, $themeId);
        }

        if (!empty($supportScripts[ $baseScript ]['settings'])) {
            $supportSettings = $supportScripts[ $baseScript ]['settings'];
        }

        if (empty($supportSettings)) {
            $form->addElement([
                'plugin' => 'static',
                'value'  => 'There are no settings for this block.',
            ]);
        } else {
            $form->addElements($supportSettings);
        }

        // check data from this case


        if ($this->request->isMethod('post') && $form->isValid($_POST)) {
            $post = $form->getData();
            $blockEntry->setBlockParamsText(json_encode($post));
            $blockEntry->save();
        } else {
            $data = [
                'eid'            => $eid,
                'blockId'        => $blockId,
                'supportBlockId' => $supportBlockId,
                'form'           => $form,
                'pageName'       => $pageName,
                'screenSize'     => $screenSize,
                'templateId'     => $templateId,
            ];

            $html = $this->partial($formScript, $data);
            $this->response = [
                'directive' => 'update',
                'html'      => $html,
            ];
        }
    }

    /**
     *
     */
    public function actionElementWrapperSetting()
    {

        $form = app()->html()->factory('\Layout\Form\Block\BlockWrapperSetting');

        $form->setData($_POST);

        $html = $this->partial('platform/layout/controller/ajax/admin-layout/element-wrapper-setting', [
            'form' => $form,
            'eid'  => $this->request->getParam('eid'),
        ]);

        $this->response = [
            'html' => $html,
        ];
    }


    /**
     *
     */
    public function actionUpdateLayout()
    {
        list($pageName, $screenSize) = $this->request->getList('pageName', 'screenSize');

        $themeId = app()->layouts()->getEditingThemeId();

        $sectionList = $this->request->getArray('sections');

        // delete old section list if not exists in this case.

        $layoutService = app()->layouts();

        $layout = app()->layouts()->findLayout($pageName, $screenSize, $themeId);

        if (!$layout instanceof Layout)
            $layout = $layoutService->createLayout($pageName, $themeId, $screenSize);

        if (!$layout instanceof Layout)
            throw new \InvalidArgumentException();

        $layoutService->updateLayout($layout, $sectionList);

    }
}