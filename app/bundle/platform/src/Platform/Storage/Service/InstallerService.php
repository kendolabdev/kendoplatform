<?php
namespace Platform\Storage\Service;

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
    protected $exportKey = 'module_platform_storage';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_storage',
        'platform_storage_adapter',
        'platform_storage_file',
        'platform_storage_file_tmp'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Storage',
        'app/template/default/platform/storage',
        'app/theme/default/sass/platform/storage',
        'app/theme/admin/sass/platform/storage',
        'static/jscript/platform/storage'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_storage'
    ];
}