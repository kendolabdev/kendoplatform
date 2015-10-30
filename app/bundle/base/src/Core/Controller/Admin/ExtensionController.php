<?php
namespace Core\Controller\Admin;

use Core\Model\CoreExtension;
use Picaso\Controller\AdminController;

/**
 * Class ExtensionController
 *
 * @package Core\Controller\Admin
 */
class ExtensionController extends AdminController
{
    /**
     *
     */
    public function actionBrowse()
    {
        \App::layout()->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_manage_extension', 'manage_package');

        if ($this->request->isPost() && !empty($_POST['select_packages'])) {
            \App::core()->extension()->doInstallPackages($_POST['select_packages']);
            \App::cache()->flush();
        }

        $packages = \App::core()->extension()->collectListAvailablePackageInformation();

        $this->view->assign([
            'isEmptyPackage' => empty($packages),
            'packages'       => $packages,
        ]);


        if ($this->request->isPost() && !empty($_POST['extension_name']) && !empty($_POST['_cmd'])) {
            $name = $_POST['extension_name'];
            $cmd = $_POST['_cmd'];

            $item = \App::table('core.core_extension')
                ->select()
                ->where('name=?', (string)$name)
                ->one();

            $ext = \App::core()
                ->extension();

            if ($item instanceof CoreExtension) {
                switch ($cmd) {
                    case 'enable':
                        $ext->enablePackage($name);
                        $item->setActive(1);
                        $item->save();
                        break;
                    case 'disable':
                        $ext->disablePackage($name);
                        $item->setActive(0);
                        $item->save();
                        break;
                    case 'upgrade';
                        $ext->upgradePackage($name);
                        $item->setVersion($ext->getPackageVersion($name));
                        $item->save();
                        break;
                }
                \App::cache()->flush();
            }
        }

        $page = 1;
        $limit = 1000;

        $paging = \App::table('core.core_extension')
            ->select()
            ->where('is_system=?', 1)
            ->paging($page, $limit);

        $paging2 = \App::table('core.core_extension')
            ->select()
            ->where('is_system=?', 0)
            ->paging($page, $limit);


        $this->view->assign([
            'paging'         => $paging,
            'paging2'        => $paging2,
            'isEmptyPackage' => empty($packages),
            'packages'       => $packages
        ]);

        $this->view->setScript('/base/core/controller/admin/extension/browse-extension');
    }

    /**
     *
     */
    public function actionConnect()
    {
        \App::layout()->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_manage_extension', 'picaso_connect');

        $this->view->setScript('/base/core/controller/admin/extension/connect-extension');
    }

    /**
     *
     */
    public function actionImport()
    {

        \App::layout()->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_manage_extension', 'import_package');

        $form = \App::html()->factory('\Core\Form\Admin\ImportExtension');

        $this->view->assign([
            'form' => $form,
        ]);

        $this->view->setScript('/base/core/controller/admin/extension/import-extension');
    }

    /**
     *
     */
    protected function init()
    {
        parent::init();

        \App::layout()->setPageName('admin_simple');

        \App::registry()->set('subnav', [
            'navId'    => 'admin',
            'parentId' => 'admin_manage_extension',
        ]);
    }
}