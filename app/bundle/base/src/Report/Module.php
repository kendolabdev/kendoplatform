<?php
namespace Report;

class Module extends \Picaso\Application\Module
{

    public function start()
    {
        \App::viewHelper()->addClassMaps([
            'btnReport' => '\Report\ViewHelper\ButtonReport',
        ]);
    }
}