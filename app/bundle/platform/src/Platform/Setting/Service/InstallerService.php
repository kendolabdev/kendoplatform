<?php

/* code generator */

namespace Platform\Setting\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Platform\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-platform-setting';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_setting',
        'platform_setting_action'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Setting',
        'app/template/default/platform/Setting',
        'app/theme/default/sass/platform/Setting',
        'app/theme/admin/sass/platform/Setting',
        'static/jscript/platform/Setting'
    ];
}