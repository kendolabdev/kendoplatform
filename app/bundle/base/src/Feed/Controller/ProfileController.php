<?php
namespace Feed\Controller;

use Core\Controller\ProfileBaseController;

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
        $profile = \App::registry()->get('profile');

        if (!\App::acl()
            ->pass($profile, 'profile__view_timeline', true)) ;

        $title = \App::text('core.$profile_profile_page', ['$profile' => $profile->getTitle()]);

        \App::assets()->title()
            ->set($title);
    }
}