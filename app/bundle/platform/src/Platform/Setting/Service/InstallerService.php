<?php
namespace Platform\Setting\Service;

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
    protected $exportKey = 'module_platform_setting';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_setting',
        'platform_setting_action'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Setting',
        'app/template/default/platform/setting',
        'app/theme/default/sass/platform/setting',
        'app/theme/admin/sass/platform/setting',
        'static/jscript/platform/setting'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_setting'
    ];
}