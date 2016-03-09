<?php

namespace Platform\Feed\Block;

use Kendo\Layout\BlockController;

/**
 * Class ActivityComposerBlock
 *
 * @package Feed\Block
 */
class ActivityComposerBlock extends BlockController
{
    /**
     * @var string
     */
    protected $basePath = 'platform/feed/block/activity-composer';

    /**
     *
     */
    public function execute()
    {
        if (!app()->auth()->logged()) {
            $this->view->setNoRender(true);

            return;
        }

        $profile = app()->registryService()->get('profile');
        $viewer = app()->auth()->getViewer();

        if (!$profile) {
            $profile = app()->auth()->getViewer();
        }

        /**
         * check privacy of profile with current viewer
         */

        if (!app()->aclService()->pass($profile, 'activity__update_status')) {
            $this->setNoRender(true);

            return;
        }


        /**
         * can control privacy? when!
         */

        $canControlPrivacy = false;

        if ($profile->viewerIsParent()) {
            $canControlPrivacy = true;
        }

        $privacyButton = app()->html()->create([
            'plugin'    => 'privacyButton',
            'name'      => 'privacy',
            'forParent' => $profile,
            'forPoster' => $viewer,
            'size'      => 'sm',
            'forAction' => 'activity__share_status',
            'alignment' => 'right',
        ]);

        $headerHtml = app()->emitter()
            ->emit('onRenderActivityComposerHeader', $profile)->__toString();

        $footerHtml = app()->emitter()
            ->emit('onRenderActivityComposerFooter', $profile)->__toString();

        $privacy = app()->relation()->getRelationOptionForSelect($profile, $viewer, 'share_status');

        $targetId = uniqid('stream');

        app()->registryService()->set('composerTargetId', $targetId);

        $this->view->assign([
            'headerHtml'        => $headerHtml,
            'footerHtml'        => $footerHtml,
            'canControlPrivacy' => $canControlPrivacy,
            'privacyButton'     => $privacyButton,
            'showPrivacy'       => $privacy != false,
            'profile'           => $profile,
            'privacy'           => $privacy,
            'viewer'            => $viewer,
            'targetId'          => $targetId,
        ]);
    }
}