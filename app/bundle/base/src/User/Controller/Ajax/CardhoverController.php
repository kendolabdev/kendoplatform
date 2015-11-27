<?php

namespace User\Controller\Ajax;

use Picaso\Controller\AjaxController;
use User\Model\User;


/**
 * Class Cardhover
 *
 * @package User\Controller\Ajax
 */
class CardhoverController extends AjaxController
{

    /**
     * Generate card hover
     */
    public function actionPreview()
    {
        $id = $this->request->getString('id');

        $subject = \App::find('user', $id);

        $followService = \App::followService();

        if (!$subject instanceof User) {
            throw new \InvalidArgumentException();
        }

        $cover = $subject->getCover();

        $canFriend = \App::authService()->getType() == 'user';
        $canMessage = true;
        $canChat = false;
        $canFollow = false;
        $isFollowing = false;
        $friendStatus = 0;
        $coverPhotoUrl = null;
        $coverPositionTop = null;

        $viewer = \App::authService()->getViewer();


        if ($viewer && $subject) {
            $canFollow = true;

        }

        if (\App::authService()->logged() && \App::authService()->getId() != $subject->getId()) {
            $isFollowing = $followService->isFollowed($viewer, $subject);


            $canFriend = true;
            $canFollow = true;
            /**
             * TO DO
             * check privacy for action method
             */
            $canMessage = true;
            $canChat = true;

            $friendStatus = \App::relationService()
                ->getMembershipStatus(\App::authService()->getViewer(), $subject);
        }


        if ($cover) {
            $coverPhotoUrl = $cover->getPhoto('origin');
            $coverPositionTop = $cover->getPositionTop() . 'px';
        }

        $this->response['cardInfo'] = $this->request->getString('cardInfo');
        $this->response['html'] = \App::viewHelper()->partial('base/user/partial/cardhover-user', [
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