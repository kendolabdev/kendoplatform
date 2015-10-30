<?php
namespace User\Block;

use Picaso\Layout\Block;

/**
 * Class TimelineHeaderBlock
 *
 * @package User\Block
 */
class TimelineHeaderBlock extends Block
{

    /**
     * @var string
     */
    protected $basePath = 'base/user/block/timeline-header';

    /**
     *
     */
    public function execute()
    {
        $viewer = \App::auth()->getViewer();
        $isFollowed = false;
        $membershipStatus = '';
        $coverPhotoUrl = null;
        $coverPositionTop = 0;


        $editcover = \App::request()->getInitiator()->getParam('editcover', 0);

        $fileId = \App::request()->getInitiator()->getParam('fileId');

        if ($fileId) {
            $coverPhotoUrl = \App::storage()->getUrlByOriginAndMaker($fileId, 'origin');
        }

        $subject = \App::registry()->get('profile');


        $canEditCover = false;
        $canEditProfile = false;

        $canChat = false;
        $canMessage = false;
        $canFollow = false;
        $canBlock = false;
        $isBlocked = false;
        $canFriend = false;


        if (\App::auth()->logged() && \App::auth()->getId() != $subject->getId()) {
            $canFriend = true;
            /**
             * TO DO
             * check privacy for action method
             */
            $canMessage = true;
            $canChat = true;
        }

        if (\App::auth()->getId() == $subject->getId() || \App::auth()->getId() == $subject->getUserId()) {
            $canEditProfile = true;
            $canEditCover = true;
        }

        /**
         * disabled friend function is user is logged as user
         */
        if (\App::auth()->getType() != 'user' || $subject->getType() != 'user') {
            $canChat = false;
            $canFriend = false;
            $canBlock = false;
        }

        if (empty($coverPhotoUrl)) {
            $cover = \App::photo()->getCover($subject);
            if ($cover) {
                $coverPhotoUrl = $cover->getPhoto('origin');
                $coverPositionTop = $cover->getPositionTop() . 'px';
            }

        }


        $canLogin = false;

        // must be login as admin
        if (\App::acl()->authorize('is_admin')) {
            if (\App::auth()->getId() != $subject->getId()) {
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

        if (\App::request()->isMobile() && !\App::request()->isTablet()) {
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
            'isOwner'               => \App::auth()->getId() == $subject->getId() ? 1 : 0,

        ]);

        if ($editing) {
            \App::assets()
                ->requirejs()
                ->addScript('editcover', 'startDraggableTimelineCoverImgForEdit()');
        }
    }
}