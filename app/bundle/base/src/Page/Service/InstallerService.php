<?php

/* code generator */

namespace Page\Service;

use Picaso\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Page\Service
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
        'page',
        'page_category'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Page',
        'app/template/default/base/page',
        'app/theme/default/sass/base/page',
        'app/theme/admin/sass/base/page',
        'static/jscript/base/page'
    ];
}