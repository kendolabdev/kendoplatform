<?php
namespace Platform\Comment;

/**
 * Class Module
 *
 * @package Base\Comment
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