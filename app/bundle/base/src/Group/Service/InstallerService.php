<?php

/* code generator */

namespace Group\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Group\Service
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
        'group',
        'group_category'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Group',
        'app/template/default/base/group',
        'app/theme/default/sass/base/group',
        'app/theme/admin/sass/base/group',
        'static/jscript/base/group'
    ];
}