<?php

namespace User\Controller;

use Attribute\Form\AttributeCustomForm;
use Core\Controller\ProfileBaseController;
use Kendo\Content\PosterInterface;
use Kendo\View\View;
use User\Model\User;

/**
 * Class ProfileController
 *
 * @package User\Controller
 */
class ProfileController extends ProfileBaseController
{
    /**
     *
     */
    public function actionEdit()
    {
        $poster = \App::registryService()->get('profile');

        if (!$poster instanceof User) ;

        $catalogId = $poster->getCatalogId();

        $form = new AttributeCustomForm([
            'catalogId' => $catalogId,
        ]);


        if ($this->request->isGet()) {

            $data = \App::catalogService()
                ->loadAttributeValue($poster, []);

            $form->setData($data);
        }


        if ($this->request->isPost() and $form->isValid($_POST)) {
            $data = $form->getData();
            
            \App::catalogService()
                ->updateItemAttribute($poster, $data);
        }

        $lp = \App::layoutService()
            ->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'form' => $form,
            ]);
    }

    /**
     * About user profile information
     */
    public function actionViewAbout()
    {

        \App::layoutService()
            ->setPageTitle('core.about');


        $profile = \App::registryService()->get('profile');
        $poster = \App::authService()->getUser();
        $subject = $profile;

        $about = \App::catalogService()
            ->getAbout($subject);

        $aboutHtml = (new View('/layout/partial/profile-about', [
            'form'    => $about,
            'poster'  => $poster,
            'subject' => $subject,
            'about'   => $about,
        ]))->render();

        $lp = \App::layoutService()->getContentLayoutParams();

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
        \App::layoutService()
            ->setPageTitle('user.friends');

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
                'pagingUrl' => 'ajax/user/friend/paging',
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'profile'   => $profile,
                'isOwner'   => $profile->viewerIsParent(),
                'lp'        => $lp,
            ]);
    }
}