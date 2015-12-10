<?php

/* code generator */

namespace Platform\Navigation\Service;

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
    protected $exportKey = 'module-platform-navigation';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_navigation',
        'platform_navigation_item'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Navigation',
        'app/template/default/platform/Navigation',
        'app/theme/default/sass/platform/Navigation',
        'app/theme/admin/sass/platform/Navigation',
        'static/jscript/platform/Navigation'
    ];
}