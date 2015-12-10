<?php

/* code generator */

namespace Base\Group\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Base\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-group';

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
        'app/template/default/base/Group',
        'app/theme/default/sass/base/Group',
        'app/theme/admin/sass/base/Group',
        'static/jscript/base/Group'
    ];
}