<?php
namespace Platform\User\Service;

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
    protected $exportKey = 'module_platform_user';

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
        'app/template/default/platform/user',
        'app/theme/default/sass/platform/user',
        'app/theme/admin/sass/platform/user',
        'static/jscript/platform/user'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_user'
    ];
}