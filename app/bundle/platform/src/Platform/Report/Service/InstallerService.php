<?php
namespace Platform\Report\Service;

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
    protected $exportKey = 'module_platform_report';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_report',
        'platform_report_category',
        'platform_report_general'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Report',
        'app/template/default/platform/report',
        'app/theme/default/sass/platform/report',
        'app/theme/admin/sass/platform/report',
        'static/jscript/platform/report'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_report'
    ];
}