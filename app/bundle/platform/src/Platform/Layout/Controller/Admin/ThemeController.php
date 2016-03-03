<?php
namespace Platform\Layout\Controller\Admin;

use Platform\Layout\Form\Admin\LayoutEditTheme;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

/**
 * Class ThemeController
 *
 * @package Platform\Layout\Controller\Admin
 */
class ThemeController extends AdminController
{

    /**
     *
     */
    protected function onBeforeRender()
    {
        \App::layouts()->setPageName('admin_simple');

        \App::layouts()
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

        \App::assetService()
            ->setTitle(\App::text('core_layout.manage_templates'));

        $paging = \App::layouts()
            ->setPageTitle('layout.manage_themes')
            ->loadAdminThemePaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'platform/layout/controller/admin/theme/browse-theme',
        ]);

        $this->view->setScript($lp)
            ->setData(['paging' => $paging]);
    }

    /**
     *
     */
    public function actionEdit()
    {

        $id = $this->request->getParam('id', 'default');
        $theme = \App::layouts()->findThemeById($id);

        $form = new LayoutEditTheme();

        if ($this->request->isMethod('get') && !empty($theme)) {
            $form->populate($theme->toArray());
        }

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $data = $form->getData();
            unset($data['theme_id'], $data['template_id']);

            if ($data['is_default']) {
                $data['is_active'] = 1;
            }

            $theme->setFromArray($data);
            $theme->save();

            if ($theme->isDefault()) {
                \App::table('platform_layout_theme')
                    ->update(['is_default' => 0])
                    ->where('theme_id <> ?', $id)
                    ->execute();
            }


            if ($theme->isEditing()) {
                \App::table('platform_layout_theme')
                    ->update(['is_editing' => 0])
                    ->where('theme_id <> ?', $id)
                    ->execute();
            }

            \App::cacheService()
                ->flush();

            \App::routing()
                ->redirect('admin', ['stuff' => 'layout/theme/browse']);
        }

        $lp = new BlockParams([
            'base_path' => 'layout/partial/form-edit'
        ]);

        $this->view
            ->setScript($lp)
            ->assign([
                'form' => $form,
            ]);
    }

}