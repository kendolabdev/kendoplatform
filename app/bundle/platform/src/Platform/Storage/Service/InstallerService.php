<?php

/* code generator */

namespace Platform\Storage\Service;

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
    protected $exportKey = 'module-platform-storage';

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
        'app/template/default/platform/Storage',
        'app/theme/default/sass/platform/Storage',
        'app/theme/admin/sass/platform/Storage',
        'static/jscript/platform/Storage'
    ];
}