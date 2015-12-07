<?php

/* code generator */

namespace Search\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Search\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-search';

    /**
     * @var array
     */
    protected $tableList = [
        
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Search',
        'app/template/default/base/search',
        'app/theme/default/sass/base/search',
        'app/theme/admin/sass/base/search',
        'static/jscript/base/search'
    ];
}