<?php
namespace Comment;

/**
 * Class Module
 *
 * @package Comment
 */
class Module extends \Kendo\Application\Module
{

    public function start()
    {
        \App::viewHelper()->addClassMaps([
            'lnComment'         => '\Comment\ViewHelper\LinkComment',
            'lnViewMoreComment' => '\Comment\ViewHelper\LinkViewMoreComment',
        ]);
    }
}