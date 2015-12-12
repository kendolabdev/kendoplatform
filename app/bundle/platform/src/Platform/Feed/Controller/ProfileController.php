<?php
namespace Platform\Feed\Controller;

use Platform\Core\Controller\ProfileBaseController;

/**
 * Class ProfileController
 *
 * @package Feed\Controller
 */
class ProfileController extends ProfileBaseController
{

    /**
     *
     */
    public function actionTimeline()
    {
        $profile = \App::registryService()->get('profile');

        if (!\App::aclService()
            ->pass($profile, 'profile__view_timeline', true)) ;

        $title = \App::text('core.$profile_profile_page', ['$profile' => $profile->getTitle()]);

        \App::assetService()->title()
            ->set($title);
    }
}