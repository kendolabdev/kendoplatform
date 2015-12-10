<?php
namespace Platform\Phrase\Controller\Admin;

use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

/**
 * Class LanguageController
 *
 * @package Platform\Phrase\Controller\Admin
 */
class LanguageController extends AdminController
{
    /**
     *
     */
    public function actionBrowse()
    {

        \App::layoutService()->setPageName('admin_simple')
            ->setPageTitle('core.manage_languages')
            ->setupSecondaryNavigation('admin', 'admin_language', 'languages');

        $items = \App::table('platform_phrase_language')
            ->select()
            ->all();

        $this->view->assign([
            'items' => $items,
        ]);

        $lp = new BlockParams([
            'base_path' => 'base/phrase/controller/admin/language/browse-language',
        ]);

        $this->view->setScript($lp);
    }
}