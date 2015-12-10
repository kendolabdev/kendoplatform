<?php

/* code generator */

namespace Base\Place\Service;

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
    protected $exportKey = 'module-base-place';

    /**
     * @var array
     */
    protected $tableList = [
        'base_place'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Place',
        'app/template/default/base/Place',
        'app/theme/default/sass/base/Place',
        'app/theme/admin/sass/base/Place',
        'static/jscript/base/Place'
    ];
}