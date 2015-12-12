<?php
namespace Platform\Place\Service;

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
    protected $exportKey = 'module_platform_place';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_place'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Place',
        'app/template/default/platform/place',
        'app/theme/default/sass/platform/place',
        'app/theme/admin/sass/platform/place',
        'static/jscript/platform/place'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_place'
    ];
}