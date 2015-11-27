<?php
namespace Mail\Controller\Admin;

use Mail\Form\Admin\EditMailTemplate;
use Mail\Form\Admin\FilterMailTemplate;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

/**
 * Class TemplateController
 *
 * @package Mail\Controller\Admin
 */
class TemplateController extends AdminController
{

    /**
     * before render
     */
    protected function onBeforeRender()
    {
        \App::layoutService()->setPageName('admin_simple');
        \App::layoutService()->setupSecondaryNavigation('admin', 'admin_setting', 'admin_manage_mail_template');
    }

    /**
     *
     */
    public function actionBrowse()
    {

        $page = $this->request->getParam('page', 1);
        $limit = 100;
        $filter = new FilterMailTemplate();

        $filter->isValid([
            'module' => $this->request->getParam('module', ''),
        ]);

        $query = $filter->getData();

        $paging = \App::mailService()
            ->loadAdminTemplatePaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'base/mail/controller/admin/template/browse-template',
            'item_path' => 'base/mail/paging/admin/browse-template',
        ]);

        $this->view
            ->setScript($lp)
            ->assign([
                'filter' => $filter,
                'paging' => $paging,
                'query'  => $query,
                'lp'     => $lp
            ]);
    }

    /**
     * @throws \Picaso\Exception
     */
    public function actionEdit()
    {
        \App::layoutService()
            ->setPageName('admin_simple');

        $name = $this->request->getParam('name', 'user_welcome');
        $languageId = 'en';

        $mailService = \App::mailService();

        $form = new EditMailTemplate();

        if ($this->request->isPost()) {

            $form->setData($_POST);
            $mailService->setTemplate($name, $languageId, $_POST);

            if (!empty($_POST['save_default'])) {
                $mailService->setDefaultTemplate($name, $_POST);
            }

        } else {

            $template = $mailService->getTemplate($name, $languageId);
            $form->setData($template);
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