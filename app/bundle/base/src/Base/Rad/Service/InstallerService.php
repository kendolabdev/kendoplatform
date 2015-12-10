<?php

/* code generator */

namespace Base\Rad\Service;

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
        'app/bundle/base/src/Base/Rad',
        'app/template/default/base/Rad',
        'app/theme/default/sass/base/Rad',
        'app/theme/admin/sass/base/Rad',
        'static/jscript/base/Rad'
    ];
}