<?php

/* code generator */

namespace Rad\Service;

use Picaso\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Rad\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-rad';

    /**
     * @var array
     */
    protected $tableList = [
        
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Rad',
        'app/template/default/base/rad',
        'app/theme/default/sass/base/rad',
        'app/theme/admin/sass/base/rad',
        'static/jscript/base/rad'
    ];
}