<?php

/* code generator */

namespace Platform\Catalog\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Platform\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-platform-catalog';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_catalog',
        'platform_catalog_field',
        'platform_catalog_field_map',
        'platform_catalog_option',
        'platform_catalog_plugin',
        'platform_catalog_section',
        'platform_catalog_section_map'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Catalog',
        'app/template/default/platform/Catalog',
        'app/theme/default/sass/platform/Catalog',
        'app/theme/admin/sass/platform/Catalog',
        'static/jscript/platform/Catalog'
    ];
}