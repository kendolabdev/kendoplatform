<?php
namespace Platform\Core\Service;

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
    protected $exportKey = 'module_platform_core';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_core_aggregate',
        'platform_core_block',
        'platform_core_extension',
        'platform_core_hook',
        'platform_core_log',
        'platform_core_profile_field',
        'platform_core_profile_value',
        'platform_core_profile_value_string',
        'platform_core_profile_value_text',
        'platform_core_type',
        'platform_core_uid_generator',
        'platform_core_value'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Core',
        'app/template/default/platform/core',
        'app/theme/default/sass/platform/core',
        'app/theme/admin/sass/platform/core',
        'static/jscript/platform/core'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_core'
    ];
}