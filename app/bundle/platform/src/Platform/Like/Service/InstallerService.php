<?php
namespace Platform\Like\Service;

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
    protected $exportKey = 'module_platform_like';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_like'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Like',
        'app/template/default/platform/like',
        'app/theme/default/sass/platform/like',
        'app/theme/admin/sass/platform/like',
        'static/jscript/platform/like'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_like'
    ];
}