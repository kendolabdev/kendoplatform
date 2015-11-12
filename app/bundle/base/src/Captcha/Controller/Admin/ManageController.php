<?php
namespace Captcha\Controller\Admin;

use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;
use Setting\Form\Admin\BaseSettingForm;


/**
 * Class CaptchaController
 *
 * @package Core\Controller\Admin
 */
class ManageController extends AdminController
{

    protected function onBeforeRender()
    {
        \App::layout()->setPageName('admin_simple');
        \App::layout()->setupSecondaryNavigation('admin', 'admin_setting', 'admin_setting_captcha');
    }

    /**
     *
     */
    public function actionBrowse()
    {

        $query = [];
        $page = 1;
        $limit = 100;

        $paging = \App::captcha()->loadAdminAdapterPaging($query, $page, $limit);


        $lp = new BlockParams([
            'base_path' => 'base/captcha/controller/admin/manage/browse-captcha',
        ]);

        $this->view
            ->setScript($lp)
            ->assign([
                'lp'        => $lp,
                'paging'    => $paging,
                'query'     => [],
                'pagingUrl' => '',
            ]);

    }

    /**
     *
     */
    public function actionEdit()
    {
        $name = $this->request->getParam('name', 'captcha.admin.recaptcha-setting');

        $arr = explode('.', $name);

        $p0 = array_shift($arr);

        foreach ($arr as $index => $ar) {
            $arr[ $index ] = \App::inflect($ar);
        }

        $class = '\\' . \App::inflect($p0) . '\\Form\\' . implode('\\', $arr);

//        if (!class_exists($class))
//            throw new \InvalidArgumentException();

        $form = \App::html()->factory($class);


        if (!$form instanceof BaseSettingForm)
            throw new \InvalidArgumentException();

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $form->save();
            \App::routing()->redirect('admin', ['stuff' => 'captcha/manage/browse']);

        }

        if ($this->request->isGet()) {
            $form->load();
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