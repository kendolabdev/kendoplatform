<?php
namespace Platform\Report;

class Module extends \Kendo\Application\Module
{

    public function start()
    {
        \App::viewHelper()->addClassMaps([
            'btnReport' => '\Report\ViewHelper\ButtonReport',
        ]);
    }
}