<?php

/* code generator */

namespace Help\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Help\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-help';

    /**
     * @var array
     */
    protected $tableList = [
        'help_category',
        'help_page',
        'help_post',
        'help_topic'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Help',
        'app/template/default/base/help',
        'app/theme/default/sass/base/help',
        'app/theme/admin/sass/base/help',
        'static/jscript/base/help'
    ];
}