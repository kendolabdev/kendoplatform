<?php

/* code generator */

namespace Layout\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Layout\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-layout';

    /**
     * @var array
     */
    protected $tableList = [
        'layout',
        'layout_block',
        'layout_block_decorator',
        'layout_page',
        'layout_section',
        'layout_setting',
        'layout_support_block',
        'layout_support_section',
        'layout_template',
        'layout_theme'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Layout',
        'app/template/default/base/layout',
        'app/theme/default/sass/base/layout',
        'app/theme/admin/sass/base/layout',
        'static/jscript/base/layout'
    ];
}