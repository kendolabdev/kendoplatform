<?php

/* code generator */

namespace Report\Service;

use Picaso\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Report\Service
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
        'report',
        'report_category',
        'report_general'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Report',
        'app/template/default/base/report',
        'app/theme/default/sass/base/report',
        'app/theme/admin/sass/base/report',
        'static/jscript/base/report'
    ];
}