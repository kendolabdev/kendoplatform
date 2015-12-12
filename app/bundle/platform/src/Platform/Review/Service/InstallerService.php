<?php
namespace Platform\Review\Service;

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
    protected $exportKey = 'module_platform_review';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_review'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Review',
        'app/template/default/platform/review',
        'app/theme/default/sass/platform/review',
        'app/theme/admin/sass/platform/review',
        'static/jscript/platform/review'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_review'
    ];
}