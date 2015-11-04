<?php
namespace Event\Controller;

use Picaso\Controller\DefaultController;

/**
 * Class HomeController
 *
 * @package Event\Controller
 */
class HomeController extends DefaultController
{

    /**
     * browse groups
     */
    public function actionBrowseEvent()
    {

        \App::layout()
            ->setupSecondaryNavigation('event_main', null, 'event_browse');

        $page = $this->request->getParam('page', 1);

        $query = [];

        $paging = \App::event()->loadEventPaging($query, $page);

        $lp = \App::layout()->getContentLayoutParams();

        $this->view
            ->setScript($lp->script())
            ->assign([
                'pagingUrl' => 'ajax/event/event/paging',
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'lp'        => $lp,
            ]);
    }

    /**
     * browse groups
     */
    public function actionMyEvent()
    {
        \App::layout()
            ->setupSecondaryNavigation('event_main', null, 'event_my');

        $page = $this->request->getParam('page', 1);

        $poster = \App::auth()->getViewer();

        $query = [
            'posterId'   => $poster->getId(),
            'posterType' => $poster->getType(),

        ];

        $paging = \App::event()->loadEventPaging($query, $page);

        $lp = \App::layout()->getContentLayoutParams();

        $this->view
            ->setScript($lp->script())
            ->assign([
                'pagingUrl' => 'ajax/event/event/paging',
                'query'     => $query,
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'lp'        => $lp,
            ]);

    }
}