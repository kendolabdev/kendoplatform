<?php
namespace Platform\Help\Service;

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
    protected $exportKey = 'module_platform_help';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_help_category',
        'platform_help_page',
        'platform_help_post',
        'platform_help_topic'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Help',
        'app/template/default/platform/help',
        'app/theme/default/sass/platform/help',
        'app/theme/admin/sass/platform/help',
        'static/jscript/platform/help'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_help'
    ];
}