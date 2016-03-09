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
        $profile = app()->registryService()->get('profile');

        if (!app()->aclService()
            ->pass($profile, 'profile__view_timeline', true)
        ) ;

        $title = app()->text('core.$profile_profile_page', ['$profile' => $profile->getTitle()]);

        app()->assetService()->title()
            ->set($title);
    }
}