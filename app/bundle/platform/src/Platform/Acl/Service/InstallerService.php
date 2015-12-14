<?php
namespace Platform\Acl\Service;

use Kendo\Kernel\ServiceInterface;
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
    protected $exportKey = 'module_platform_acl';

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
        'app/template/default/platform/acl',
        'app/theme/default/sass/platform/acl',
        'app/theme/admin/sass/platform/acl',
        'static/jscript/platform/acl'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_acl'
    ];
}