<?php

/* code generator */

namespace Follow\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Follow\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-follow';

    /**
     * @var array
     */
    protected $tableList = [
        'follow'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Follow',
        'app/template/default/base/follow',
        'app/theme/default/sass/base/follow',
        'app/theme/admin/sass/base/follow',
        'static/jscript/base/follow'
    ];
}