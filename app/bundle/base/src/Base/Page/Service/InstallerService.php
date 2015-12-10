<?php

/* code generator */

namespace Base\Page\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Base\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-page';

    /**
     * @var array
     */
    protected $tableList = [
        'base_page',
        'base_page_category'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Page',
        'app/template/default/base/Page',
        'app/theme/default/sass/base/Page',
        'app/theme/admin/sass/base/Page',
        'static/jscript/base/Page'
    ];
}