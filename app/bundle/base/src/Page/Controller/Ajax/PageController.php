<?php
namespace Page\Controller\Ajax;

use Page\Model\Page;
use Kendo\Controller\AjaxController;


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

        $paging = \App::pageService()->loadPagePaging($query, $page);

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

        $viewer = \App::authService()->getViewer();

        if (!$item instanceof Page)
            throw new \InvalidArgumentException();

        $likeStatus = \App::likeService()->getLikeStatus($viewer, $item->getId());

        $followStatus = \App::followService()->getFollowStatus($viewer, $item->getId());


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