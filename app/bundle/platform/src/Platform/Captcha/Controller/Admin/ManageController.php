<?php
namespace Platform\Captcha\Controller\Admin;

use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;
use Platform\Setting\Form\Admin\BaseSettingForm;


/**
 * Class CaptchaController
 *
 * @package Core\Controller\Admin
 */
class ManageController extends AdminController
{

    protected function onBeforeRender()
    {
        \App::layoutService()->setPageName('admin_simple');
        \App::layoutService()->setupSecondaryNavigation('admin', 'admin_setting', 'admin_setting_captcha');
    }

    /**
     *
     */
    public function actionBrowse()
    {

        $query = [];
        $page = 1;
        $limit = 100;

        $paging = \App::captchaService()->loadAdminAdapterPaging($query, $page, $limit);


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

        $form = \App::htmlService()->factory($class);


        if (!$form instanceof BaseSettingForm)
            throw new \InvalidArgumentException();

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $form->save();
            \App::routingService()->redirect('admin', ['stuff' => 'captcha/manage/browse']);

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