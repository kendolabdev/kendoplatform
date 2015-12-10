<?php

namespace Platform\User\Controller\Ajax;

use Kendo\Controller\AjaxController;
use Kendo\Layout\BlockParams;

/**
 * Class Platform\UserController
 *
 * @package Platform\User\Controller\Ajax
 */
class UserController extends AjaxController
{
    /**
     *
     */
    public function actionBearAccountDialog()
    {
        $lp = \App::layoutService()
            ->getContentLayoutParams('user_ajax_bear_account_dialog');

        $this->response = [
            'html' => $this->partial($lp->script(), []),
        ];
    }

    /**
     *
     */
    public function actionPaging()
    {
        $page = $this->request->getParam('page', 1);

        $query = $this->request->getArray('query');

        $paging = \App::userService()->loadUserPaging($query, $page);

        $lp = new BlockParams($this->request->getParam('lp'));

        $html = $this->partial($lp->itemScript(), [
            'paging' => $paging,
            'lp'     => $lp
        ]);

        $this->response = [
            'hasNext' => $paging->hasNext(),
            'hasPrev' => $paging->hasPrev(),
            'query'   => $query,
            'pager'   => $paging->getPager(),
            'html'    => $html,
        ];
    }
}