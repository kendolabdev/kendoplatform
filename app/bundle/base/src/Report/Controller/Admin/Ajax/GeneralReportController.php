<?php

namespace Report\Controller\Admin\Ajax;

use Picaso\Controller\AjaxController;
use Picaso\Layout\BlockParams;

/**
 * Class GeneralReportController
 *
 * @package Report\Controller\Admin\Ajax
 */
class GeneralReportController extends AjaxController
{
    /**
     *
     */
    public function actionPaging()
    {
        $page = $this->request->getParam('page', 1);
        $query = $this->request->getArray('query');

        $paging = \App::report()->loadAdminGeneralReportPaging($query, $page);

        $lp = new BlockParams($this->request->getParam('lp'));

        $html = $this->partial($lp->itemScript(), [
            'paging' => $paging,
            'lp'     => $lp
        ]);

        $this->response = [
            'html'    => $html,
            'pager'   => $paging->getPager(),
            'query'   => $query,
            'hasNext' => $paging->hasNext(),
            'hasPrev' => $paging->hasPrev(),
        ];
    }

}