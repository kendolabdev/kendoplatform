<?php
namespace Platform\User\Block;

use Kendo\Layout\Block;

/**
 * Class TimelineHeaderBlock
 *
 * @package Platform\User\Block
 */
class TimelineHeaderBlock extends Block
{

    /**
     * @var string
     */
    protected $basePath = 'platform/user/block/timeline-header';

    /**
     *
     */
    public function execute()
    {
        $viewer = \App::authService()->getViewer();
        $isFollowed = false;
        $membershipStatus = '';
        $coverPhotoUrl = null;
        $coverPositionTop = 0;


        $editcover = \App::requestService()->getInitiator()->getParam('editcover', 0);

        $fileId = \App::requestService()->getInitiator()->getParam('fileId');

        if ($fileId) {
            $coverPhotoUrl = \App::storageService()->getUrlByOriginAndMaker($fileId, 'origin');
        }

        $subject = \App::registryService()->get('profile');


        $canEditCover = false;
        $canEditProfile = false;

        $canChat = false;
        $canMessage = false;
        $canFollow = false;
        $canBlock = false;
        $isBlocked = false;
        $canFriend = false;


        if (\App::authService()->logged() && \App::authService()->getId() != $subject->getId()) {
            $canFriend = true;
            /**
             * TO DO
             * check privacy for action method
             */
            $canMessage = true;
            $canChat = true;
        }

        if (\App::authService()->getId() == $subject->getId() || \App::authService()->getId() == $subject->getUserId()) {
            $canEditProfile = true;
            $canEditCover = true;
        }

        /**
         * disabled friend function is user is logged as user
         */
        if (\App::authService()->getType() != 'user' || $subject->getType() != 'user') {
            $canChat = false;
            $canFriend = false;
            $canBlock = false;
        }

        if (empty($coverPhotoUrl)) {
            $cover = \App::photoService()->getCover($subject);
            if ($cover) {
                $coverPhotoUrl = $cover->getPhoto('origin');
                $coverPositionTop = $cover->getPositionTop() . 'px';
            }

        }


        $canLogin = false;

        // must be login as admin
        if (\App::aclService()->authorize('is_admin')) {
            if (\App::authService()->getId() != $subject->getId()) {
                $canLogin = true;
            }
        }


        $profileTabMenuOptions = [
            'level0'       => 'nav nav-inline nav-profile-tab',
            'level1'       => 'dropdown-menu dropdown-menu-right',
            'depth'        => 1,
            'max'          => _screen(10, 7, 4),
            'dropdownIcon' => '',
        ];

        if (\App::requestService()->isMobile() && !\App::requestService()->isTablet()) {
            $profileTabMenuOptions['level0'] = 'nav nav-justify nav-profile-tab';
            $profileTabMenuOptions['moreLabel'] = '<b class="ion-more"></b>';
        }

        $editing = $editcover and $canEditCover and $coverPhotoUrl;


        $this->view->assign([
            'canLogin'              => $canLogin,
            'profile'               => $subject,
            'isFollowed'            => $isFollowed,
            'canEditCover'          => $canEditCover,
            'canEditProfile'        => $canEditProfile,
            'canChat'               => $canChat,
            'canFollow'             => $canFollow,
            'canBlock'              => $canBlock,
            'canMessage'            => $canMessage,
            'isBlocked'             => $isBlocked,
            'canFriend'             => $canFriend,
            'dataSubject'           => $subject->toSimpleAttrs(),
            'coverPhotoUrl'         => $coverPhotoUrl,
            'coverPositionTop'      => $coverPositionTop,
            'membershipStatus'      => $membershipStatus,
            'editing'               => $editing,
            'profileTabMenuOptions' => $profileTabMenuOptions,
            'fileId'                => $fileId,
            'isOwner'               => \App::authService()->getId() == $subject->getId() ? 1 : 0,

        ]);

        if ($editing) {
            \App::assetService()
                ->requirejs()
                ->addScript('editcover', 'startDraggableTimelineCoverImgForEdit()');
        }
    }
}