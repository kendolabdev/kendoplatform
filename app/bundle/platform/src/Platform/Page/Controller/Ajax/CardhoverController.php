<?php

namespace Platform\Page\Controller\Ajax;

use Platform\Page\Model\Page;
use Kendo\Controller\AjaxController;


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

        $subject = app()->find('page', $id);

        if (!$subject instanceof Page) {
            throw new \InvalidArgumentException();
        }

        $cover = $subject->getCover();

        $canFriend = app()->auth()->getType() == 'user';
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

        $viewer = app()->auth()->getViewer();

        if ($viewer && $subject) {
            $canFollow = true;
            $followService = app()->followService();
            $isFollowing = $followService->isFollowed($viewer, $subject);
        }


        $this->response['cardInfo'] = $this->request->getString('cardInfo');
        $this->response['html'] = app()->viewHelper()->partial('platform/page/partial/cardhover-page', [
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