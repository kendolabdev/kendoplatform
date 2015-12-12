<?php

namespace Platform\User\ViewHelper;

/**
 * Class ButtonTopbarViewer
 */
class ButtonTopbarViewer
{
    /**
     * @return string
     */
    public function __invoke()
    {
        if (!\App::authService()->logged()) return '';

        $viewer = \App::authService()->getViewer();
        $title = $viewer->getTitle();
        $firstName = $title;
        $avatar = $viewer->getPhoto('avatar_sm');

        if (($pos = strpos($title, ' ')) > 0) {
            $firstName = substr($title, 0, $pos);
        }


        return \App::viewHelper()->partial('platform/user/button/topbar-viewer', [
            'avatar'    => $avatar,
            'viewer'    => $viewer,
            'title'     => $title,
            'firstName' => $firstName,
        ]);
    }
}