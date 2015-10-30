<?php
namespace Event\Controller\Ajax;

use Picaso\Controller\AjaxController;

/**
 * Class EventController
 *
 * @package Event\Controller\Ajax
 */
class EventController extends AjaxController
{

    /**
     * Support ajax paging pattern
     */
    public function actionPaging()
    {
        $query = $this->request->getParam('query');

        $page = $this->request->getParam('page', 1);

        $paging = \App::event()->loadEventPaging($query, $page);

        $this->response = [
            'hasNext' => $paging->hasNext(),
            'hasPrev' => $paging->hasPrev(),
            'query'   => $query,
            'pager'   => $paging->getPager(),
            'html'    => $this->partial('base/event/partial/event-paging', ['paging' => $paging]),
        ];
    }
}