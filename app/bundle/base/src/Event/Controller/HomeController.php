<?php
namespace Event\Controller;

use Event\Form\FilterEvent;
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
        $filter  = new FilterEvent();

        \App::layout()
            ->setupSecondaryNavigation('event_main', null, 'event_browse')
            ->setPageFilter($filter)
            ->setPageTitle('event.events');

        $page = $this->request->getParam('page', 1);

        $query = [];

        $paging = \App::event()->loadEventPaging($query, $page);


        $lp = \App::layout()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
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
            ->setupSecondaryNavigation('event_main', null, 'event_my')
            ->setPageTitle('event.events');

        \App::acl()
            ->required('is_member',false);

        $page = $this->request->getParam('page', 1);

        $poster = \App::auth()->getViewer();



        $query = [
            'posterId'   => $poster->getId(),
            'posterType' => $poster->getType(),

        ];

        $paging = \App::event()->loadEventPaging($query, $page);

        $lp = \App::layout()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/event/event/paging',
                'query'     => $query,
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'lp'        => $lp,
            ]);

    }

    /**
     *
     */
    public function actionCreateEvent()
    {
        \App::layout()
            ->setupSecondaryNavigation('event_main', null, 'event_my')
            ->setPageTitle('event.events');
    }
}