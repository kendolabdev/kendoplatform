<?php

namespace Social\Controller\Admin;

use Setting\Form\Admin\BaseSettingForm;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

/**
 * Class SettingController
 *
 * @package Social\Controller\Admin
 */
class SettingController extends AdminController
{

    protected function onBeforeRender()
    {
        \App::layout()->setPageName('admin_simple');
        \App::layout()->setupSecondaryNavigation('admin', 'admin_setting', 'admin_setting_social');
    }

    /**
     * Browse service listing
     */
    public function actionBrowse()
    {

        $paging = \App::table('social.social_service')
            ->select()
            ->order('sort_order', 1)
            ->paging(1, 100);

        $lp = new BlockParams([
            'base_path' => 'base/social/controller/admin/setting/browse-service',
        ]);

        $this->view
            ->setScript($lp->script())
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
            $arr[ $index ] = \App::inflect($ar);
        }

        $class = '\\' . \App::inflect($p0) . '\\Form\\' . implode('\\', $arr);

        if (!class_exists($class))
            throw new \InvalidArgumentException();

        $form = \App::html()->factory($class);


        if (!$form instanceof BaseSettingForm)
            throw new \InvalidArgumentException();

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $form->save();
            \App::routing()->redirect('admin', ['stuff' => 'social/setting/browse']);
        }

        if ($this->request->isGet()) {
            $form->load();
        }

        $this->view
            ->setScript('base/form-edit')
            ->assign([
                'form' => $form,
            ]);

    }
}