<?php
namespace Base\Event\Controller;

use Base\Event\Form\FilterEvent;
use Kendo\Controller\DefaultController;

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

        \App::layoutService()
            ->setupSecondaryNavigation('event_main', null, 'event_browse')
            ->setPageFilter($filter)
            ->setPageTitle('event.events');

        $page = $this->request->getParam('page', 1);

        $query = [];

        $paging = \App::eventService()->loadEventPaging($query, $page);


        $lp = \App::layoutService()->getContentLayoutParams();

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
        \App::layoutService()
            ->setupSecondaryNavigation('event_main', null, 'event_my')
            ->setPageTitle('event.events');

        \App::aclService()
            ->required('is_member',false);

        $page = $this->request->getParam('page', 1);

        $poster = \App::authService()->getViewer();



        $query = [
            'posterId'   => $poster->getId(),
            'posterType' => $poster->getType(),

        ];

        $paging = \App::eventService()->loadEventPaging($query, $page);

        $lp = \App::layoutService()->getContentLayoutParams();

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
        \App::layoutService()
            ->setupSecondaryNavigation('event_main', null, 'event_my')
            ->setPageTitle('event.events');
    }
}