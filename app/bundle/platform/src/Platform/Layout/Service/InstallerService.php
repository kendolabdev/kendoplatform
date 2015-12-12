<?php
namespace Platform\Layout\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Code generator
 *
 * Class InstallerService
 *
 * @package Platform\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module_platform_layout';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_layout',
        'platform_layout_block',
        'platform_layout_block_decorator',
        'platform_layout_page',
        'platform_layout_section',
        'platform_layout_setting',
        'platform_layout_support_block',
        'platform_layout_support_section',
        'platform_layout_template',
        'platform_layout_theme'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Layout',
        'app/template/default/platform/layout',
        'app/theme/default/sass/platform/layout',
        'app/theme/admin/sass/platform/layout',
        'static/jscript/platform/layout'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_layout'
    ];
}