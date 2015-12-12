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
    protected $exportKey = 'module_base_rad';

    /**
     * @var array
     */
    protected $tableList = [
        
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Rad',
        'app/template/default/base/rad',
        'app/theme/default/sass/base/rad',
        'app/theme/admin/sass/base/rad',
        'static/jscript/base/rad'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'base_rad'
    ];
}