<?php

namespace Page\Controller\Ajax;

use Activity\Service\FollowService;
use Page\Model\Page;
use Picaso\Controller\AjaxController;


/**
 * Class CardhoverController
 *
 * @package Page\Controller\Ajax
 */
class CardhoverController extends AjaxController
{

    /**
     * Generate card hover
     */
    public function actionPreview()
    {
        $id = $this->request->getString('id');

        $subject = \App::find('page', $id);

        if (!$subject instanceof Page) {
            throw new \InvalidArgumentException();
        }

        $cover = $subject->getCover();

        $canFriend = \App::authService()->getType() == 'user';
        $canMessage = false;
        $canChat = false;
        $canFollow = false;
        $isFollowing = false;
        $friendStatus = 0;
        $coverPhotoUrl = null;
        $coverPositionTop = null;

        if ($cover) {
            $coverPhotoUrl = $cover->getPhoto('origin');
            $coverPositionTop = $cover->getPositionTop() . 'px';
        }

        $viewer = \App::authService()->getViewer();

        if ($viewer && $subject) {
            $canFollow = true;
            $followService = \App::followService();
            $isFollowing = $followService->isFollowed($viewer, $subject);
        }


        $this->response['cardInfo'] = $this->request->getString('cardInfo');
        $this->response['html'] = \App::viewHelper()->partial('base/page/partial/cardhover-page', [
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