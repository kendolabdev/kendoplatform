<?php

/* code generator */

namespace Setting\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Setting\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-setting';

    /**
     * @var array
     */
    protected $tableList = [
        'setting',
        'setting_action'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Setting',
        'app/template/default/base/setting',
        'app/theme/default/sass/base/setting',
        'app/theme/admin/sass/base/setting',
        'static/jscript/base/setting'
    ];
}