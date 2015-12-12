<?php
namespace Base\Group\Service;

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
    protected $exportKey = 'module_base_group';

    /**
     * @var array
     */
    protected $tableList = [
        'base_group',
        'base_group_category'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Group',
        'app/template/default/base/group',
        'app/theme/default/sass/base/group',
        'app/theme/admin/sass/base/group',
        'static/jscript/base/group'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'base_group'
    ];
}