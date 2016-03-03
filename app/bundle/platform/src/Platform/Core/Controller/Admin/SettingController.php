<?php
namespace Platform\Core\Controller\Admin;

use Kendo\Layout\BlockParams;
use Platform\Setting\Form\Admin\BaseSettingForm;
use Kendo\Controller\AdminController;

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

        \App::layouts()
            ->setPageName('admin_edit');
    }

    /**
     *
     */
    public function actionGeneral()
    {

        $active = $this->request->getParam('t', 'admin_setting_general');


        \App::layouts()->setupSecondaryNavigation('admin', 'admin_setting', $active);

        $this->request->forward( null, 'edit');
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

        $form = \App::htmlService()->factory($class);


        if (!$form instanceof BaseSettingForm)
            throw new \InvalidArgumentException();

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $form->save();
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