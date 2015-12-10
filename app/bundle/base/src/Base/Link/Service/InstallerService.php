<?php

/* code generator */

namespace Base\Link\Service;

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
    protected $exportKey = 'module-platform-link';

    /**
     * @var array
     */
    protected $tableList = [
        'base_link'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Link',
        'app/template/default/platform/Link',
        'app/theme/default/sass/platform/Link',
        'app/theme/admin/sass/platform/Link',
        'static/jscript/platform/Link'
    ];
}