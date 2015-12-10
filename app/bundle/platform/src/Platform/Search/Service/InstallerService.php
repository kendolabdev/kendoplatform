<?php

/* code generator */

namespace Platform\Search\Service;

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
    protected $exportKey = 'module-platform-search';

    /**
     * @var array
     */
    protected $tableList = [
        
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Search',
        'app/template/default/platform/Search',
        'app/theme/default/sass/platform/Search',
        'app/theme/admin/sass/platform/Search',
        'static/jscript/platform/Search'
    ];
}