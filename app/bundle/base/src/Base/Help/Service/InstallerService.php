<?php

/* code generator */

namespace Base\Help\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Base\Service
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
        'base_help_category',
        'base_help_page',
        'base_help_post',
        'base_help_topic'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Help',
        'app/template/default/base/Help',
        'app/theme/default/sass/base/Help',
        'app/theme/admin/sass/base/Help',
        'static/jscript/base/Help'
    ];
}