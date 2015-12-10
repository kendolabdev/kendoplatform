<?php

/* code generator */

namespace Base\Review\Service;

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
    protected $exportKey = 'module-base-review';

    /**
     * @var array
     */
    protected $tableList = [
        'base_review'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Review',
        'app/template/default/base/Review',
        'app/theme/default/sass/base/Review',
        'app/theme/admin/sass/base/Review',
        'static/jscript/base/Review'
    ];
}