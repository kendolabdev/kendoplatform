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
        if (!app()->auth()->logged()) return '';

        $viewer = app()->auth()->getViewer();
        $title = $viewer->getTitle();
        $firstName = $title;
        $avatar = $viewer->getPhoto('avatar_sm');

        if (($pos = strpos($title, ' ')) > 0) {
            $firstName = substr($title, 0, $pos);
        }


        return app()->viewHelper()->partial('platform/user/button/topbar-viewer', [
            'avatar'    => $avatar,
            'viewer'    => $viewer,
            'title'     => $title,
            'firstName' => $firstName,
        ]);
    }
}