<?php
namespace Phrase\Controller\Admin;

use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

/**
 * Class LanguageController
 *
 * @package Phrase\Controller\Admin
 */
class LanguageController extends AdminController
{
    /**
     *
     */
    public function actionBrowse()
    {

        \App::layout()->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_language', 'languages');

        $items = \App::table('phrase.phrase_language')
            ->select()
            ->all();

        $this->view->assign([
            'items' => $items,
        ]);

        $lp = new BlockParams([
            'base_path' => 'base/phrase/controller/admin/language/browse-language',
        ]);

        $this->view->setScript($lp->script());
    }
}