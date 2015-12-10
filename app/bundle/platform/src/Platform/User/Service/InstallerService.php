<?php

/* code generator */

namespace Platform\User\Service;

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
    protected $exportKey = 'module-platform-user';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_user',
        'platform_user_attribute_value',
        'platform_user_auth_password',
        'platform_user_auth_remote',
        'platform_user_token'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/User',
        'app/template/default/platform/User',
        'app/theme/default/sass/platform/User',
        'app/theme/admin/sass/platform/User',
        'static/jscript/platform/User'
    ];
}