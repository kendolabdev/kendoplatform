<?php

namespace Base\Share;

class Module extends \Kendo\Application\Module
{
    public function start()
    {

        \App::viewHelper()->addClassMaps([
            'lnShare'         => '\Share\ViewHelper\LinkShare',
            'listShareSample' => '\Share\ViewHelper\ListShareSample',
        ]);
    }
}