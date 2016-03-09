<?php
namespace Platform\Group\Controller\Ajax;

use Kendo\Controller\AjaxController;
use Kendo\Layout\BlockParams;

/**
 * Class GroupController
 *
 * @package Group\Controller\Ajax
 */
class GroupController extends AjaxController
{

    /**
     * Support ajax paging pattern
     */
    public function actionPaging()
    {
        list($page, $query, $lp) = $this->request->getList('page', 'query', 'lp');

        $lp = new BlockParams($lp);

        $paging = app()->groupService()->loadGroupPaging($query, $page);


        $html = $this->partial($lp->script(), ['paging' => $paging]);

        $this->response = [
            'html'    => $html,
            'pager'   => $paging->getPager(),
            'hasNext' => $paging->hasNext(),
            'hasPrev' => $paging->hasPrev(),
        ];
    }
}