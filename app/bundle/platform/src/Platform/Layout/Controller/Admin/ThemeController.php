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
        app()->layouts()->setPageName('admin_simple');

        app()->layouts()
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

        app()->assetService()
            ->setTitle(app()->text('core_layout.manage_templates'));

        $paging = app()->layouts()
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
        $theme = app()->layouts()->findThemeById($id);

        $form = new LayoutEditTheme();

        if ($this->request->isMethod('get') && !empty($theme)) {
            $form->populate($theme->toArray());
        }

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $data = $form->getData();
            unset($data['theme_id']);

            if ($data['is_default']) {
                $data['is_active'] = 1;
            }

            $theme->setFromArray($data);
            $theme->save();

            if ($theme->isDefault()) {
                app()->table('platform_layout_theme')
                    ->update(['is_default' => 0])
                    ->where('theme_id <> ?', $id)
                    ->execute();
            }


            if ($theme->isEditing()) {
                app()->table('platform_layout_theme')
                    ->update(['is_editing' => 0])
                    ->where('theme_id <> ?', $id)
                    ->execute();
            }

            app()->cacheService()
                ->flush();

            app()->routing()
                ->redirect('admin', ['any' => 'layout/theme/browse']);
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