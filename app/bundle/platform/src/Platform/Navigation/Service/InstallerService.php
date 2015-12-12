<?php
namespace Platform\Navigation\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Code generator
 *
 * Class InstallerService
 *
 * @package Platform\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module_platform_navigation';

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
        'app/template/default/platform/navigation',
        'app/theme/default/sass/platform/navigation',
        'app/theme/admin/sass/platform/navigation',
        'static/jscript/platform/navigation'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_navigation'
    ];
}