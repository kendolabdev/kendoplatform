<?php
namespace Platform\Mail\Controller\Admin;

use Platform\Setting\Form\Admin\BaseSettingForm;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

/**
 * Class TransportController
 *
 * @package Core\Controller\Admin
 */
class TransportController extends AdminController
{
    /**
     * before render
     */
    protected function onBeforeRender()
    {
        \App::layouts()->setPageName('admin_simple');
        \App::layouts()->setupSecondaryNavigation('admin', 'admin_setting', 'admin_manage_mail');
    }

    /**
     * Browse all mail sender transports
     */
    public function actionBrowse()
    {
        $lp = new BlockParams([
            'base_path' => 'platform/mail/controller/admin/transport/browse-transport',
        ]);

        $query = [];

        $paging = \App::mailService()
            ->loadAdminTransportPaging($query, 1, 100);

        $this->view->setScript($lp)
            ->assign([
                'paging' => $paging,
                'lp'     => $lp,
                'query'  => $query,
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

        $form = \App::htmlService()->factory($class);


        if (!$form instanceof BaseSettingForm)
            throw new \InvalidArgumentException();

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $form->save();
            \App::routing()->redirect('admin', ['stuff' => 'mail/transport/browse']);

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