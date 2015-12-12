<?php
namespace Platform\Event\Controller\Ajax;

use Kendo\Controller\AjaxController;

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

        $paging = \App::eventService()->loadEventPaging($query, $page);

        $this->response = [
            'hasNext' => $paging->hasNext(),
            'hasPrev' => $paging->hasPrev(),
            'query'   => $query,
            'pager'   => $paging->getPager(),
            'html'    => $this->partial('platform/event/partial/event-paging', ['paging' => $paging]),
        ];
    }
}