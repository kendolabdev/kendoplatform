<?php

namespace Base\Feed\Block;

use Kendo\Layout\Block;

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
        if (!\App::authService()->logged()) {
            $this->view->setNoRender(true);

            return;
        }

        $profile = \App::registryService()->get('profile');
        $viewer = \App::authService()->getViewer();

        if (!$profile) {
            $profile = \App::authService()->getViewer();
        }

        /**
         * check privacy of profile with current viewer
         */

        if (!\App::aclService()->pass($profile, 'activity__update_status')) {
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

        $privacyButton = \App::htmlService()->create([
            'plugin'    => 'privacyButton',
            'name'      => 'privacy',
            'forParent' => $profile,
            'forPoster' => $viewer,
            'size'      => 'sm',
            'forAction' => 'activity__share_status',
            'alignment' => 'right',
        ]);

        $headerHtml = \App::hookService()
            ->notify('onRenderActivityComposerHeader', $profile)->__toString();

        $footerHtml = \App::hookService()
            ->notify('onRenderActivityComposerFooter', $profile)->__toString();

        $privacy = \App::relationService()->getRelationOptionForSelect($profile, $viewer, 'share_status');

        $targetId = uniqid('stream');

        \App::registryService()->set('composerTargetId', $targetId);

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