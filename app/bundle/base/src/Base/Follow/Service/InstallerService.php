<?php

/* code generator */

namespace Base\Follow\Service;

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
    protected $exportKey = 'module-base-follow';

    /**
     * @var array
     */
    protected $tableList = [
        'base_follow'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Follow',
        'app/template/default/base/Follow',
        'app/theme/default/sass/base/Follow',
        'app/theme/admin/sass/base/Follow',
        'static/jscript/base/Follow'
    ];
}