<?php
namespace Layout\Controller\Admin;

use Layout\Form\Admin\LayoutEditTheme;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

/**
 * Class ThemeController
 *
 * @package Layout\Controller\Admin
 */
class ThemeController extends AdminController
{

    /**
     *
     */
    protected function onBeforeRender()
    {
        \App::layout()->setPageName('admin_simple');

        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_appearance', 'themes');
    }

    /**
     *
     */
    public function actionBrowse()
    {
        $query = [];
        $limit = 100;
        $page = 1;

        \App::assets()
            ->setTitle(\App::text('core_layout.manage_templates'));

        $paging = \App::layout()
            ->loadAdminThemePaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'base/layout/controller/admin/theme/browse-theme',
        ]);


        $this->view->setScript($lp->script())
            ->setData(['paging' => $paging]);
    }

    /**
     *
     */
    public function actionEdit()
    {

        $id = $this->request->getParam('id', 'default');
        $theme = \App::layout()->findThemeById($id);

        $form = new LayoutEditTheme();

        if ($this->request->isGet() && !empty($theme)) {
            $form->populate($theme->toArray());
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $data = $form->getData();
            unset($data['theme_id'], $data['template_id']);

            if ($data['is_default']) {
                $data['is_active'] = 1;
            }

            $theme->setFromArray($data);
            $theme->save();

            if ($theme->isDefault()) {
                \App::table('layout.layout_theme')
                    ->update(['is_default' => 0])
                    ->where('theme_id <> ?', $id)
                    ->execute();
            }


            if ($theme->isEditing()) {
                \App::table('layout.layout_theme')
                    ->update(['is_editing' => 0])
                    ->where('theme_id <> ?', $id)
                    ->execute();
            }

            \App::cache()
                ->flush();

            \App::routing()
                ->redirect('admin', ['stuff' => 'layout/theme/browse']);
        }

        $this->view->setScript('base/form-edit')
            ->assign(['form' => $form]);
    }

}