<?php
namespace Platform\Event\Controller;

use Platform\Core\Controller\ProfileBaseController;
use Kendo\Content\PosterInterface;

/**
 * Class ProfileController
 *
 * @package Event\Controller
 */
class ProfileController extends ProfileBaseController
{

    /**
     *
     */
    public function actionViewAbout()
    {

    }


    /**
     *
     */
    public function actionBrowseEvent()
    {
        app()->layouts()
            ->setPageTitle('event.events');

        $profile = app()->registryService()->get('profile');

        $page = $this->request->getParam('page', 1);

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $paging = app()->eventService()
            ->loadEventPaging($query, $page);

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
     *
     */
    public function actionBrowseMember()
    {
        $profile = app()->registryService()->get('profile');

        if (!$profile instanceof PosterInterface)
            throw new \InvalidArgumentException();

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $page = $this->request->getParam('page', 1);

        $paging = app()->relation()->loadMemberPaging($query, $page);

        $lp = app()->layouts()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/event/event/paging',
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'profile'   => $profile,
                'isOwner'   => $profile->viewerIsParent(),
                'lp'        => $lp,
            ]);
    }
}