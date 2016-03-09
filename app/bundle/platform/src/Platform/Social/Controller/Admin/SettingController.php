<?php

namespace Platform\Social\Controller\Admin;

use Platform\Setting\Form\Admin\BaseSettingForm;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

/**
 * Class SettingController
 *
 * @package Social\Controller\Admin
 */
class SettingController extends AdminController
{

    protected function onBeforeRender()
    {
        app()->layouts()->setPageName('admin_simple');
        app()->layouts()->setupSecondaryNavigation('admin', 'admin_setting', 'admin_setting_social');
    }

    /**
     * Browse service listing
     */
    public function actionBrowse()
    {
        $paging = app()->table('platform_social_service')
            ->select()
            ->order('sort_order', 1)
            ->paging(1, 100);

        $lp = new BlockParams([
            'base_path' => 'platform/social/controller/admin/setting/browse-service',
        ]);

        $this->view
            ->setScript($lp)
            ->assign([
                'paging'    => $paging,
                'query'     => [],
                'lp'        => $lp,
                'pagingUrl' => '',
            ]);
    }

    /**
     *
     */
    public function actionEdit()
    {

        $name = $this->request->getParam('name', 'core.admin.general-setting');

        $arr = explode('.', $name);

        $p0 = array_shift($arr);

        foreach ($arr as $index => $ar) {
            $arr[ $index ] = _inflect($ar);
        }

        $class = '\\' . _inflect($p0) . '\\Form\\' . implode('\\', $arr);

        if (!class_exists($class))
            throw new \InvalidArgumentException();

        $form = app()->htmlService()->factory($class);


        if (!$form instanceof BaseSettingForm)
            throw new \InvalidArgumentException();

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $form->save();
            app()->routing()->redirect('admin', ['stuff' => 'social/setting/browse']);
        }

        if ($this->request->isMethod('get')) {
            $form->load();
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