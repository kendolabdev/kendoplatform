<?php
namespace Page\Controller;

use Core\Controller\ProfileBaseController;

/**
 * Class ProfileController
 *
 * @package Page\Controller
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
     * @return bool
     */
    public function actionBrowseMember()
    {
        return $this->forward('\Activity\Controller\ProfileController', 'browse-like');
    }

    /**
     *
     */
    public function actionBrowsePage()
    {
        $profile = \App::registry()->get('profile');

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $page = $this->request->getParam('page', 1);

        $paging = \App::page()->loadPagePaging($query, $page);

        $lp = \App::layout()->getContentLayoutParams();

        $this->view
            ->setScript($lp->itemScript())
            ->assign([
                'paging'  => $paging,
                'pager'   => $paging->getPager(),
                'query'   => $query,
                'profile' => $profile,
                'lp'      => $lp,
            ]);
    }
}