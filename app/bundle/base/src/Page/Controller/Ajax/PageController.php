<?php
namespace Page\Controller\Ajax;

use Page\Model\Page;
use Picaso\Controller\AjaxController;


/**
 * Class PageController
 *
 * @package Page\Controller\Ajax
 */
class PageController extends AjaxController
{

    /**
     * Support ajax paging pattern
     */
    public function actionPaging()
    {
        $page = $this->request->getParam('page', 1);

        $query = $this->request->getArray('query');

        $paging = \App::page()->loadPagePaging($query, $page);

        $this->response = [
            'html'    => $this->partial('base/page/partial/page-paging', ['paging' => $paging]),
            'pager'   => $paging->getPager(),
            'hasNext' => $paging->hasNext(),
            'hasPrev' => $paging->hasPrev(),
        ];
    }

    public function actionMembershipOptions()
    {

        list($type, $id, $eid) = $this->request->get('type', 'id', 'eid');

        $item = \App::find($type, $id);

        $viewer = \App::auth()->getViewer();

        if (!$item instanceof Page)
            throw new \InvalidArgumentException();

        $likeStatus = \App::like()->getLikeStatus($viewer, $item->getId());

        $followStatus = \App::follow()->getFollowStatus($viewer, $item->getId());


        $this->response = [
            'html' => $this->partial('base/page/partial/membership-options', [
                'eid'          => $eid,
                'item'         => $item,
                'likeStatus'   => $likeStatus,
                'followStatus' => $followStatus,
            ])
        ];
    }
}