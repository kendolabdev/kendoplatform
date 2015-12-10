<?php

/* code generator */

namespace Base\Tag\Service;

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
    protected $exportKey = 'module-platform-tag';

    /**
     * @var array
     */
    protected $tableList = [
        'base_tag_people'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Tag',
        'app/template/default/platform/Tag',
        'app/theme/default/sass/platform/Tag',
        'app/theme/admin/sass/platform/Tag',
        'static/jscript/platform/Tag'
    ];
}