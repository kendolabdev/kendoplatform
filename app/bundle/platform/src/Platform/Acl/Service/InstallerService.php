<?php

/* code generator */

namespace Platform\Acl\Service;

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
    protected $exportKey = 'module-platform-acl';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_acl_action',
        'platform_acl_allow',
        'platform_acl_group',
        'platform_acl_role'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Acl',
        'app/template/default/platform/Acl',
        'app/theme/default/sass/platform/Acl',
        'app/theme/admin/sass/platform/Acl',
        'static/jscript/platform/Acl'
    ];
}