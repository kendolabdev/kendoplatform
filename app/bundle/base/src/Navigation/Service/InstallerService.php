<?php

/* code generator */

namespace Navigation\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Navigation\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-navigation';

    /**
     * @var array
     */
    protected $tableList = [
        'navigation',
        'navigation_item'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Navigation',
        'app/template/default/base/navigation',
        'app/theme/default/sass/base/navigation',
        'app/theme/admin/sass/base/navigation',
        'static/jscript/base/navigation'
    ];
}