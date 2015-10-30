<?php

namespace Feed\Block;

use Picaso\Layout\Block;

/**
 * Class ActivityComposerBlock
 *
 * @package Feed\Block
 */
class ActivityComposerBlock extends Block
{
    /**
     * @var string
     */
    protected $basePath = 'base/feed/block/activity-composer';

    /**
     *
     */
    public function execute()
    {
        if (!\App::auth()->logged()) {
            $this->view->setNoRender(true);

            return;
        }

        $profile = \App::registry()->get('profile');
        $viewer = \App::auth()->getViewer();

        if (!$profile) {
            $profile = \App::auth()->getViewer();
        }

        /**
         * check privacy of profile with current viewer
         */

        if (!\App::acl()->pass($profile, 'activity__update_status')) {
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

        $privacyButton = \App::html()->create([
            'plugin'    => 'privacyButton',
            'name'      => 'privacy',
            'forParent' => $profile,
            'forPoster' => $viewer,
            'size'      => 'sm',
            'forAction' => 'activity__share_status',
            'alignment' => 'right',
        ]);

        $headerHtml = \App::hook()
            ->notify('onRenderActivityComposerHeader', $profile)->getResponseHtml();

        $footerHtml = \App::hook()
            ->notify('onRenderActivityComposerFooter', $profile)->getResponseHtml();

        $privacy = \App::relation()->getRelationOptionForSelect($profile, $viewer, 'share_status');

        $targetId = uniqid('stream');

        \App::registry()->set('composerTargetId', $targetId);

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