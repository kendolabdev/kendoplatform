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
        \App::layoutService()->setPageName('admin_simple');

        \App::layoutService()
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

        $paging = \App::layoutService()
            ->setPageTitle('layout.manage_themes')
            ->loadAdminThemePaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'base/layout/controller/admin/theme/browse-theme',
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
        $theme = \App::layoutService()->findThemeById($id);

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

            \App::cacheService()
                ->flush();

            \App::routingService()
                ->redirect('admin', ['stuff' => 'layout/theme/browse']);
        }

        $lp = new BlockParams([
            'base_path'=> 'layout/partial/form-edit'
        ]);

        $this->view
            ->setScript($lp)
            ->assign([
                'form' => $form,
            ]);
    }

}