<?php
namespace Platform\Rad\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Code generator
 *
 * Class InstallerService
 *
 * @package Base\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module_platform_rad';

    /**
     * @var array
     */
    protected $tableList = [
        
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Rad',
        'app/template/default/platform/rad',
        'app/theme/default/sass/platform/rad',
        'app/theme/admin/sass/platform/rad',
        'static/jscript/platform/rad'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_rad'
    ];
}