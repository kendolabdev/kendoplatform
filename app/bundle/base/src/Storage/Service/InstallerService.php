<?php

/* code generator */

namespace Storage\Service;

use Picaso\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Storage\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-storage';

    /**
     * @var array
     */
    protected $tableList = [
        'storage',
        'storage_adapter',
        'storage_file',
        'storage_file_tmp'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Storage',
        'app/template/default/base/storage',
        'app/theme/default/sass/base/storage',
        'app/theme/admin/sass/base/storage',
        'static/jscript/base/storage'
    ];
}