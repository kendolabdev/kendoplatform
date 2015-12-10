<?php

/* code generator */

namespace Platform\Core\Service;

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
    protected $exportKey = 'module-platform-core';

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
        'app/template/default/platform/Core',
        'app/theme/default/sass/platform/Core',
        'app/theme/admin/sass/platform/Core',
        'static/jscript/platform/Core'
    ];
}