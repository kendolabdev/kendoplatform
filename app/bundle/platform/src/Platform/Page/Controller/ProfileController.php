<?php
namespace Platform\Page\Controller;

use Platform\Core\Controller\ProfileBaseController;

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

        \App::layoutService()
            ->setPageTitle('page.pages');

        $profile = \App::registryService()->get('profile');

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $page = $this->request->getParam('page', 1);

        $paging = \App::pageService()->loadPagePaging($query, $page);

        $lp = \App::layoutService()->getContentLayoutParams();

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