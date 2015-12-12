<?php
namespace Platform\Social\Service;

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
    protected $exportKey = 'module_platform_social';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_social_service'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Social',
        'app/template/default/platform/social',
        'app/theme/default/sass/platform/social',
        'app/theme/admin/sass/platform/social',
        'static/jscript/platform/social'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_social'
    ];
}