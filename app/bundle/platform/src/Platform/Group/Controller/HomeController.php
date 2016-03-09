<?php
namespace Platform\Group\Controller;

use Platform\Group\Form\FilterGroup;
use Kendo\Controller\DefaultController;

/**
 * Class HomeController
 *
 * @package Group\Controller
 */
class HomeController extends DefaultController
{

    /**
     * browse groups
     */
    public function actionBrowseGroup()
    {

        $filter = new FilterGroup();
        $page = $this->request->getParam('page', 1);
        $query = [];


        $lp = app()->layouts()->getContentLayoutParams();



        $paging = app()->groupService()->loadGroupPaging($query, $page);




        app()->layouts()
            ->setupSecondaryNavigation('group_main', null, 'group_browse')
            ->setPageFilter($filter)
            ->setPageTitle('group.groups');

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/group/group/paging',
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'lp'        => $lp,
            ]);
    }

    /**
     * browse my groups
     */
    public function actionMyGroup()
    {
        $page = $this->request->getParam('page', 1);

        app()->layouts()
            ->setupSecondaryNavigation('group_main', null, 'group_my')
            ->setPageTitle('group.groups');

        $poster = app()->auth()->getViewer();

        $query = [
            'posterId'   => $poster->getId(),
            'posterType' => $poster->getType(),
        ];

        $paging = app()->groupService()->loadGroupPaging($query, $page);

        $lp = app()->layouts()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/group/group/paging',
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'lp'        => $lp,
            ]);
    }

    public function actionCreateGroup()
    {
        app()->layouts()
            ->setupSecondaryNavigation('group_main', null, 'group_my')
            ->setPageTitle('group.groups');
    }

}