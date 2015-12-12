<?php
namespace Platform\Share\Service;

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
    protected $exportKey = 'module_platform_share';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_share'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Share',
        'app/template/default/platform/share',
        'app/theme/default/sass/platform/share',
        'app/theme/admin/sass/platform/share',
        'static/jscript/platform/share'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_share'
    ];
}