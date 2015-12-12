<?php
namespace Platform\Core\Controller\Admin;

use Platform\Core\Model\CoreExtension;
use Kendo\Controller\AdminController;

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
        \App::layoutService()->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_manage_package', 'manage_package')
            ->setPageTitle('core.your_packages');

        if ($this->request->isPost() && !empty($_POST['select_packages'])) {
            \App::coreService()->extension()->doInstallPackages($_POST['select_packages']);
            \App::cacheService()->flush();
        }

        $packages = \App::coreService()->extension()->collectListAvailablePackageInformation();

        $this->view->assign([
            'isEmptyPackage' => empty($packages),
            'packages'       => $packages,
        ]);


        if ($this->request->isPost() && !empty($_POST['extension_name']) && !empty($_POST['_cmd'])) {
            $name = $_POST['extension_name'];
            $cmd = $_POST['_cmd'];

            $item = \App::table('platform_core_extension')
                ->select()
                ->where('name=?', (string)$name)
                ->one();

            $ext = \App::coreService()
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
                \App::cacheService()
                    ->flush();
            }
        }

        $page = 1;
        $limit = 1000;

        $modules = \App::table('platform_core_extension')
            ->select()
            ->where('extension_type=?', 'module')
            ->where('is_installed=?', 1)
            ->order('is_system', -1)
            ->paging($page, $limit);

        $themes = \App::table('platform_core_extension')
            ->select()
            ->where('extension_type=?', 'theme')
            ->where('is_installed=?', 1)
            ->order('is_system', -1)
            ->paging($page, $limit);


        $this->view->assign([
            'modules'        => $modules,
            'themes'         => $themes,
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
        \App::layoutService()->setPageName('admin_simple')
            ->setPageTitle('core.connect_store')
            ->setupSecondaryNavigation('admin', 'admin_manage_package', 'KENDO_connect');

        $this->view->setScript('/base/core/controller/admin/extension/connect-extension');
    }

    /**
     *
     */
    public function actionImport()
    {

        \App::layoutService()->setPageName('admin_simple')
            ->setPageTitle('core.upload_packages')
            ->setupSecondaryNavigation('admin', 'admin_manage_package', 'import_package');

        $form = \App::htmlService()->factory('\Platform\Core\Form\Admin\ImportExtension');

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

        \App::layoutService()->setPageName('admin_simple');

        \App::registryService()->set('subnav', [
            'navId'    => 'admin',
            'parentId' => 'admin_manage_package',
        ]);
    }
}