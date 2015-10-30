<?php
namespace Mail\Controller\Admin;

use Setting\Form\Admin\BaseSettingForm;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

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
        \App::layout()->setPageName('admin_simple');
        \App::layout()->setupSecondaryNavigation('admin', 'admin_setting', 'admin_manage_mail');
    }

    /**
     * Browse all mail sender transports
     */
    public function actionBrowse()
    {
        $lp = new BlockParams([
            'base_path' => 'base/mail/controller/admin/transport/browse-transport',
        ]);

        $query = [];

        $paging = \App::mail()
            ->loadAdminTransportPaging($query, 1, 100);

        $this->view->setScript($lp->script())
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
            \App::routing()->redirect('admin', ['stuff' => 'mail/transport/browse']);

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