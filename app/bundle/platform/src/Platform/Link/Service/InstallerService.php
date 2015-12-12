<?php
namespace Platform\Link\Service;

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
    protected $exportKey = 'module_platform_link';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_link'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Link',
        'app/template/default/platform/link',
        'app/theme/default/sass/platform/link',
        'app/theme/admin/sass/platform/link',
        'static/jscript/platform/link'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_link'
    ];
}