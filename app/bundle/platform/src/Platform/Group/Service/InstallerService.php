<?php
namespace Platform\Group\Service;

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
    protected $exportKey = 'module_platform_group';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_group',
        'platform_group_category'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Group',
        'app/template/default/platform/group',
        'app/theme/default/sass/platform/group',
        'app/theme/admin/sass/platform/group',
        'static/jscript/platform/group'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_group'
    ];
}