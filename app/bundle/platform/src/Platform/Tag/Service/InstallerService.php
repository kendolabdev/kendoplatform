<?php
namespace Platform\Tag\Service;

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
    protected $exportKey = 'module_platform_tag';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_tag_people'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Tag',
        'app/template/default/platform/tag',
        'app/theme/default/sass/platform/tag',
        'app/theme/admin/sass/platform/tag',
        'static/jscript/platform/tag'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_tag'
    ];
}