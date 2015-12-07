<?php

/* code generator */

namespace Place\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Place\Service
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
        'place'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Place',
        'app/template/default/base/place',
        'app/theme/default/sass/base/place',
        'app/theme/admin/sass/base/place',
        'static/jscript/base/place'
    ];
}