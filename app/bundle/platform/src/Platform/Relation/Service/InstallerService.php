<?php

/* code generator */

namespace Platform\Relation\Service;

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
    protected $exportKey = 'module-platform-relation';

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
        'app/template/default/platform/Relation',
        'app/theme/default/sass/platform/Relation',
        'app/theme/admin/sass/platform/Relation',
        'static/jscript/platform/Relation'
    ];
}