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
        app()->layouts()->setPageName('admin_simple');
        app()->layouts()->setupSecondaryNavigation('admin', 'admin_setting', 'admin_setting_captcha');
    }

    /**
     *
     */
    public function actionBrowse()
    {

        $query = [];
        $page = 1;
        $limit = 100;

        $paging = app()->captcha()->loadAdminAdapterPaging($query, $page, $limit);


        $lp = new BlockParams([
            'base_path' => 'platform/captcha/controller/admin/manage/browse-captcha',
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
            $arr[ $index ] = _inflect($ar);
        }

        $class = '\\' . _inflect($p0) . '\\Form\\' . implode('\\', $arr);

//        if (!class_exists($class))
//            throw new \InvalidArgumentException();

        $form = app()->html()->factory($class);


        if (!$form instanceof BaseSettingForm)
            throw new \InvalidArgumentException();

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $form->save();
            app()->routing()->redirect('admin', ['stuff' => 'captcha/manage/browse']);

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