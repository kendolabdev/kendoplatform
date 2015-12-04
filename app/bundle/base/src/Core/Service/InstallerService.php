<?php

/* code generator */

namespace Core\Service;

use Picaso\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Core\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-core';

    /**
     * @var array
     */
    protected $tableList = [
        'core_aggregate',
        'core_block',
        'core_extension',
        'core_hook',
        'core_log',
        'core_profile_field',
        'core_profile_value',
        'core_profile_value_string',
        'core_profile_value_text',
        'core_type',
        'core_uid_generator',
        'core_value'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'robots.txt',
        'index.php',
        'app/init.php',
        'app/composer.json',
        'app/config',
        'app/vendor',
        'app/bundle/kendo',
        'app/template/default/layout',
        'static/jscript/kendo',
        'static/jscript/dist',
        'install/',
        'app/bundle/base/src/Core',
        'app/template/default/base/core',
        'app/theme/default/sass/base/core',
        'app/theme/admin/sass/base/core',
        'static/jscript/base/core'
    ];
}