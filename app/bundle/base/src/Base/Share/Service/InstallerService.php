<?php

/* code generator */

namespace Base\Share\Service;

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
    protected $exportKey = 'module-base-share';

    /**
     * @var array
     */
    protected $tableList = [
        'base_share'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Share',
        'app/template/default/base/Share',
        'app/theme/default/sass/base/Share',
        'app/theme/admin/sass/base/Share',
        'static/jscript/base/Share'
    ];
}