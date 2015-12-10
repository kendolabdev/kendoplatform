<?php
namespace Base\Event\Controller;

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
        \App::layoutService()
            ->setPageTitle('event.events');

        $profile = \App::registryService()->get('profile');

        $page = $this->request->getParam('page', 1);

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $paging = \App::eventService()
            ->loadEventPaging($query, $page);

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
     *
     */
    public function actionBrowseMember()
    {
        $profile = \App::registryService()->get('profile');

        if (!$profile instanceof PosterInterface)
            throw new \InvalidArgumentException();

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $page = $this->request->getParam('page', 1);

        $paging = \App::relationService()->loadMemberPaging($query, $page);

        $lp = \App::layoutService()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/event/event/paging',
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'profile'   => $profile,
                'isOwner'   => $profile->viewerIsParent(),
                'lp'        => $lp,
            ]);
    }
}