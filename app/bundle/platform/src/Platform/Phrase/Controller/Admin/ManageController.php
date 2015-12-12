<?php
namespace Platform\Phrase\Controller\Admin;

use Platform\Phrase\Form\Admin\FilterPhrase;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

/**
 * Class ManageController
 *
 * @package Platform\Phrase\Controller\Admin
 */
class ManageController extends AdminController
{

    /**
     *
     */
    public function actionBrowse()
    {
        $filter = new FilterPhrase();

        \App::layoutService()->setPageName('admin_simple')
            ->setPageFilter($filter)
            ->setPageTitle('core.manage_phrases')
            ->setupSecondaryNavigation('admin', 'admin_language', 'translation');

        /**
         * save translation
         */
        if ($this->request->isPost()) {
            $this->_saveTranslation($_POST['translation']);
        }

        $langId = $this->request->getParam('langId', 'en');

        $filter->isValid($this->request->getParams());

        $query = [
            'q'      => $this->request->getParam('q', ''),
            'langId' => $langId,
        ];

        $page = $this->request->getParam('page', 1);

        $paging = \App::phraseService()
            ->loadAdminPhrasePaging($query, $page);

        $lp = new BlockParams([
            'base_path' => 'base/phrase/controller/admin/manage/browse-phrase',
            'item_path' => 'base/phrase/paging/admin/browse-phrase',
        ]);

        $this->view->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/core/phrase/paging',
                'query'     => $query,
                'paging'    => $paging,
                'filter'    => $filter,
                'lp'        => $lp,
                'langId'    => $langId,
            ]);
    }

    private function _saveTranslation($data)
    {

        $tableValue = \App::table('platform_phrase_value');

        /**
         * match phrase id by language
         */
        foreach ($data as $langId => $phrases) {
            foreach ($phrases as $phraseId => $phraseValue) {
                $row = $tableValue->select()
                    ->where('phrase_id=?', $phraseId)
                    ->where('language_id=?', $langId)
                    ->one();
                if (null == $row) {
                    $row = $tableValue
                        ->fetchNew([
                            'phrase_id'   => $phraseId,
                            'language_id' => $langId
                        ]);
                }
                $row->__set('phrase_value', $phraseValue);
                $row->save();
            }
        }
    }

    /**
     *
     */
    public function actionImport()
    {
        \App::layoutService()->setPageName('admin_simple')
            ->setPageTitle('phrase.import_phrases')
            ->setupSecondaryNavigation('admin', 'admin_language', 'import');

        $lp = new BlockParams([
            'base_path' => 'base/phrase/controller/admin/manage/import',
        ]);

        $this->view->setScript($lp);
    }
}