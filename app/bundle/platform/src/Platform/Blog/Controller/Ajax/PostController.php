<?php
namespace Platform\Blog\Controller\Ajax;

use Kendo\Controller\AjaxController;
use Kendo\Layout\BlockParams;


/**
 * Class PostController
 *
 * @package Base\Blog\Controller\Ajax
 */
class PostController extends AjaxController
{
    /**
     * Paging ajax pattern
     */
    public function actionPaging()
    {
        $page = $this->request->getParam('page', 1);

        $query = $this->request->getArray('query');

        $paging = app()->blogService()->loadPostPaging($query, $page);

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