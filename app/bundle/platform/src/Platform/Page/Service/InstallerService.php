<?php
namespace Platform\Page\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Code generator
 *
 * Class InstallerService
 *
 * @package Base\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module_platform_page';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_page',
        'platform_page_category'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Page',
        'app/template/default/platform/page',
        'app/theme/default/sass/platform/page',
        'app/theme/admin/sass/platform/page',
        'static/jscript/platform/page'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_page'
    ];
}