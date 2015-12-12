<?php
namespace Platform\Relation\Service;

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
    protected $exportKey = 'module_platform_relation';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_relation',
        'platform_relation_item',
        'platform_relation_request',
        'platform_relation_type'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Relation',
        'app/template/default/platform/relation',
        'app/theme/default/sass/platform/relation',
        'app/theme/admin/sass/platform/relation',
        'static/jscript/platform/relation'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_relation'
    ];
}