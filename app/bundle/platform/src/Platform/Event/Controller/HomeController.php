<?php
namespace Platform\Event\Controller;

use Platform\Event\Form\FilterEvent;
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
        $filter = new FilterEvent();

        app()->layouts()
            ->setupSecondaryNavigation('event_main', null, 'event_browse')
            ->setPageFilter($filter)
            ->setPageTitle('event.events');

        $page = $this->request->getParam('page', 1);

        $query = [];

        $paging = app()->eventService()->loadEventPaging($query, $page);


        $lp = app()->layouts()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/event/event/paging',
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
        app()->layouts()
            ->setupSecondaryNavigation('event_main', null, 'event_my')
            ->setPageTitle('event.events');

        app()->aclService()
            ->required('is_member', false);

        $page = $this->request->getParam('page', 1);

        $poster = app()->auth()->getViewer();


        $query = [
            'posterId'   => $poster->getId(),
            'posterType' => $poster->getType(),

        ];

        $paging = app()->eventService()->loadEventPaging($query, $page);

        $lp = app()->layouts()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/event/event/paging',
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
        app()->layouts()
            ->setupSecondaryNavigation('event_main', null, 'event_my')
            ->setPageTitle('event.events');
    }
}