<?php

/* code generator */

namespace Tag\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Tag\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-tag';

    /**
     * @var array
     */
    protected $tableList = [
        'tag_people'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Tag',
        'app/template/default/base/tag',
        'app/theme/default/sass/base/tag',
        'app/theme/admin/sass/base/tag',
        'static/jscript/base/tag'
    ];
}