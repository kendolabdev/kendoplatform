<?php
namespace Base\Report\Service;

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
    protected $exportKey = 'module_base_report';

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
        'app/template/default/base/report',
        'app/theme/default/sass/base/report',
        'app/theme/admin/sass/base/report',
        'static/jscript/base/report'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'base_report'
    ];
}