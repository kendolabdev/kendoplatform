<?php

namespace Platform\User\Controller\Ajax;

use Kendo\Controller\AjaxController;
use Platform\User\Model\User;


/**
 * Class Cardhover
 *
 * @package Platform\User\Controller\Ajax
 */
class CardhoverController extends AjaxController
{

    /**
     * Generate card hover
     */
    public function actionPreview()
    {
        $id = $this->request->getString('id');

        $subject = app()->find('user', $id);

        $followService = app()->followService();

        if (!$subject instanceof User) {
            throw new \InvalidArgumentException();
        }

        $cover = $subject->getCover();

        $canFriend = app()->auth()->getType() == 'user';
        $canMessage = true;
        $canChat = false;
        $canFollow = false;
        $isFollowing = false;
        $friendStatus = 0;
        $coverPhotoUrl = null;
        $coverPositionTop = null;

        $viewer = app()->auth()->getViewer();


        if ($viewer && $subject) {
            $canFollow = true;

        }

        if (app()->auth()->logged() && app()->auth()->getId() != $subject->getId()) {
            $isFollowing = $followService->isFollowed($viewer, $subject);


            $canFriend = true;
            $canFollow = true;
            /**
             * TO DO
             * check privacy for action method
             */
            $canMessage = true;
            $canChat = true;

            $friendStatus = app()->relation()
                ->getMembershipStatus(app()->auth()->getViewer(), $subject);
        }


        if ($cover) {
            $coverPhotoUrl = $cover->getPhoto('origin');
            $coverPositionTop = $cover->getPositionTop() . 'px';
        }

        $this->response['cardInfo'] = $this->request->getString('cardInfo');
        $this->response['html'] = app()->viewHelper()->partial('platform/user/partial/cardhover-user', [
            'profile'          => $subject,
            'canFriend'        => $canFriend,
            'canMessage'       => $canMessage,
            'canFollow'        => $canFollow,
            'isFollowing'      => $isFollowing,
            'cover'            => $cover,
            'friendStatus'     => $friendStatus,
            'coverPhotoUrl'    => $coverPhotoUrl,
            'coverPositionTop' => $coverPositionTop,
            'canChat'          => $canChat,
            'dataSubject'      => [
                'id'   => $subject->getId(),
                'type' => $subject->getType(),
            ]
        ]);
    }
}