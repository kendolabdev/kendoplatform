<?php

namespace Platform\User\Controller;

use Platform\Core\Controller\ProfileBaseController;
use Kendo\Content\PosterInterface;
use Kendo\View\View;
use Platform\User\Model\User;

/**
 * Class ProfileController
 *
 * @package Platform\User\Controller
 */
class ProfileController extends ProfileBaseController
{
    /**
     *
     */
    public function actionEdit()
    {
        $poster = app()->registryService()->get('profile');

        if (!$poster instanceof User) ;

        $catalogId = $poster->getCatalogId();
//
//        $form = new AttributeCustomForm([
//            'catalogId' => $catalogId,
//        ]);
//
//
//        if ($this->request->is('get')) {
//
//            $data = app()->catalogService()
//                ->loadAttributeValue($poster, []);
//
//            $form->setData($data);
//        }
//
//        if ($this->request->isMethod('post')and $form->isValid($_POST)) {
//            $data = $form->getData();
//
//            app()->catalogService()
//                ->updateItemAttribute($poster, $data);
//        }
//
//        $lp = app()->layoutService()
//            ->getContentLayoutParams();
//
//        $this->view
//            ->setScript($lp)
//            ->assign([
//                'form' => $form,
//            ]);
    }

    /**
     * About user profile information
     */
    public function actionViewAbout()
    {

        app()->layouts()
            ->setPageTitle('core.about');


        $profile = app()->registryService()->get('profile');
        $poster = app()->auth()->getUser();
        $subject = $profile;

        $about = app()->catalogService()
            ->getAbout($subject);

        $aboutHtml = (new View('/layout/partial/profile-about', [
            'form'    => $about,
            'poster'  => $poster,
            'subject' => $subject,
            'about'   => $about,
        ]))->render();

        $lp = app()->layouts()->getContentLayoutParams();

        /**
         * get about information
         */

        $this->view
            ->setScript($lp)
            ->assign([
                'aboutHtml' => $aboutHtml,
            ]);
    }

    /**
     *
     */
    public function actionBrowseMember()
    {
        app()->layouts()
            ->setPageTitle('user.friends');

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
                'pagingUrl' => 'ajax/platform/user/friend/paging',
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'profile'   => $profile,
                'isOwner'   => $profile->viewerIsParent(),
                'lp'        => $lp,
            ]);
    }
}