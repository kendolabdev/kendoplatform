<?php
namespace Platform\Follow\Service;

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
    protected $exportKey = 'module_platform_follow';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_follow'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Follow',
        'app/template/default/platform/follow',
        'app/theme/default/sass/platform/follow',
        'app/theme/admin/sass/platform/follow',
        'static/jscript/platform/follow'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_follow'
    ];
}