<?php
namespace Comment;

/**
 * Class Module
 *
 * @package Comment
 */
class Module extends \Picaso\Application\Module
{

    public function start()
    {
        \App::viewHelper()->addClassMaps([
            'lnComment'         => '\Comment\ViewHelper\LinkComment',
            'lnViewMoreComment' => '\Comment\ViewHelper\LinkViewMoreComment',
        ]);
    }
}