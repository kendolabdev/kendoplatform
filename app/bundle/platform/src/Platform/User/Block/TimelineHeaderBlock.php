<?php
namespace Platform\User\Block;

use Kendo\Layout\BlockController;

/**
 * Class TimelineHeaderBlock
 *
 * @package Platform\User\Block
 */
class TimelineHeaderBlock extends BlockController
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
        $viewer = app()->auth()->getViewer();
        $isFollowed = false;
        $membershipStatus = '';
        $coverPhotoUrl = null;
        $coverPositionTop = 0;


        $editcover = app()->requester()->getParam('editcover', 0);

        $fileId = app()->requester()->getParam('fileId');

        if ($fileId) {
            $coverPhotoUrl = app()->storageService()->getUrlByOriginAndMaker($fileId, 'origin');
        }

        $subject = app()->registryService()->get('profile');


        $canEditCover = false;
        $canEditProfile = false;

        $canChat = false;
        $canMessage = false;
        $canFollow = false;
        $canBlock = false;
        $isBlocked = false;
        $canFriend = false;


        if (app()->auth()->logged() && app()->auth()->getId() != $subject->getId()) {
            $canFriend = true;
            /**
             * TO DO
             * check privacy for action method
             */
            $canMessage = true;
            $canChat = true;
        }

        if (app()->auth()->getId() == $subject->getId() || app()->auth()->getId() == $subject->getUserId()) {
            $canEditProfile = true;
            $canEditCover = true;
        }

        /**
         * disabled friend function is user is logged as user
         */
        if (app()->auth()->getType() != 'user' || $subject->getType() != 'user') {
            $canChat = false;
            $canFriend = false;
            $canBlock = false;
        }

        if (empty($coverPhotoUrl)) {
            $cover = app()->photoService()->getCover($subject);
            if ($cover) {
                $coverPhotoUrl = $cover->getPhoto('origin');
                $coverPositionTop = $cover->getPositionTop() . 'px';
            }

        }


        $canLogin = false;

        // must be login as admin
        if (app()->aclService()->authorize('is_admin')) {
            if (app()->auth()->getId() != $subject->getId()) {
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

        if (app()->requester() && !app()->requester()->isTablet()) {
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
            'isOwner'               => app()->auth()->getId() == $subject->getId() ? 1 : 0,

        ]);

        if ($editing) {
            app()->assetService()
                ->requirejs()
                ->addScript('editcover', 'startDraggableTimelineCoverImgForEdit()');
        }
    }
}