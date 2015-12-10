<?php

/* code generator */

namespace Base\Report\Service;

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
    protected $exportKey = 'module-base-report';

    /**
     * @var array
     */
    protected $tableList = [
        'base_report',
        'base_report_category',
        'base_report_general'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Report',
        'app/template/default/base/Report',
        'app/theme/default/sass/base/Report',
        'app/theme/admin/sass/base/Report',
        'static/jscript/base/Report'
    ];
}