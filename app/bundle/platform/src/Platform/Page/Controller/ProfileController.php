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
        return $this->request->forward('Platform\Feed\Controller\ProfileController', 'browse-like');
    }

    /**
     *
     */
    public function actionBrowsePage()
    {

        app()->layouts()
            ->setPageTitle('page.pages');

        $profile = app()->registryService()->get('profile');

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $page = $this->request->getParam('page', 1);

        $paging = app()->pageService()->loadPagePaging($query, $page);

        $lp = app()->layouts()->getContentLayoutParams();

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