<?php
namespace Platform\Search\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Code generator
 *
 * Class InstallerService
 *
 * @package Platform\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module_platform_search';

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
        'app/template/default/platform/search',
        'app/theme/default/sass/platform/search',
        'app/theme/admin/sass/platform/search',
        'static/jscript/platform/search'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_search'
    ];
}