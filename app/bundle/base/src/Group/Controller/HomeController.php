<?php
namespace Group\Controller;

use Group\Form\FilterGroup;
use Picaso\Controller\DefaultController;

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

        $paging = \App::groupService()->loadGroupPaging($query, $page);

        $lp = \App::layoutService()->getContentLayoutParams();

        \App::layoutService()
            ->setupSecondaryNavigation('group_main', null, 'group_browse')
            ->setPageFilter($filter)
            ->setPageTitle('group.groups');

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/group/group/paging',
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

        \App::layoutService()
            ->setupSecondaryNavigation('group_main', null, 'group_my')
            ->setPageTitle('group.groups');

        $poster = \App::authService()->getViewer();

        $query = [
            'posterId'   => $poster->getId(),
            'posterType' => $poster->getType(),
        ];

        $paging = \App::groupService()->loadGroupPaging($query, $page);

        $lp = \App::layoutService()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/group/group/paging',
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'lp'        => $lp,
            ]);
    }

    public function actionCreateGroup()
    {
        \App::layoutService()
            ->setupSecondaryNavigation('group_main', null, 'group_my')
            ->setPageTitle('group.groups');
    }

}