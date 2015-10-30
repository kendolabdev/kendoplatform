<?php

namespace User\ViewHelper;

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
        if (!\App::auth()->logged()) return '';

        $viewer = \App::auth()->getViewer();
        $title = $viewer->getTitle();
        $firstName = $title;
        $avatar = $viewer->getPhoto('avatar_sm');

        if (($pos = strpos($title, ' ')) > 0) {
            $firstName = substr($title, 0, $pos);
        }


        return \App::viewHelper()->partial('base/user/button/topbar-viewer', [
            'avatar'    => $avatar,
            'viewer'    => $viewer,
            'title'     => $title,
            'firstName' => $firstName,
        ]);
    }
}