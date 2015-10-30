<?php
namespace Core\Controller\Admin;

use Setting\Form\Admin\BaseSettingForm;
use Picaso\Controller\AdminController;

/**
 * Class SettingController
 *
 * @package Core\Controller\Admin
 */
class SettingController extends AdminController
{
    protected function init()
    {
        parent::init();

        \App::layout()
            ->setPageName('admin_edit');

        $this->view->setScript('base/form-edit');
    }

    /**
     *
     */
    public function actionGeneral()
    {

        $active = $this->request->getParam('t', 'admin_setting_general');


        \App::layout()->setupSecondaryNavigation('admin', 'admin_setting', $active);

        $this->forward(null, 'edit');
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
        }

        if ($this->request->isGet()) {
            $form->load();
        }

        $this->view->assign([
            'form' => $form,
        ]);

    }
}