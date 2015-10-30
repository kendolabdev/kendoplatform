<?php

namespace User\Controller;

use Attribute\Form\AttributeCustomForm;
use Core\Controller\ProfileBaseController;
use Picaso\Content\Poster;
use Picaso\View\View;
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
        $poster = \App::registry()->get('profile');

        if (!$poster instanceof User) ;

        $catalogId = $poster->getCatalogId();

        $form = new AttributeCustomForm([
            'catalogId' => $catalogId,
        ]);


        if ($this->request->isGet()) {

            $data = \App::attribute()
                ->loadAttributeValue($poster, []);

            $form->setData($data);
        }


        if ($this->request->isPost() and $form->isValid($_POST)) {
            $data = $form->getData();
            
            \App::attribute()
                ->updateItemAttribute($poster, $data);
        }

        $lp = \App::layout()
            ->getContentLayoutParams();

        $this->view
            ->setScript($lp->script())
            ->assign([
                'form' => $form,
            ]);
    }

    /**
     * About user profile information
     */
    public function actionViewAbout()
    {

        $profile = \App::registry()->get('profile');
        $poster = \App::auth()->getUser();
        $subject = $profile;

        $about = \App::attribute()
            ->getAbout($subject);

        $aboutHtml = (new View('/layout/partial/profile-about', [
            'form'    => $about,
            'poster'  => $poster,
            'subject' => $subject,
            'about'   => $about,
        ]))->render();

        $lp = \App::layout()->getContentLayoutParams();

        /**
         * get about information
         */

        $this->view
            ->setScript($lp->script())
            ->assign([
                'aboutHtml' => $aboutHtml,
            ]);
    }

    /**
     *
     */
    public function actionBrowseMember()
    {
        $profile = \App::registry()->get('profile');


        if (!$profile instanceof Poster)
            throw new \InvalidArgumentException();

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $page = $this->request->getParam('page', 1);

        $paging = \App::relation()->loadMemberPaging($query, $page);

        $lp = \App::layout()->getContentLayoutParams();

        $this->view
            ->setScript($lp->script())
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