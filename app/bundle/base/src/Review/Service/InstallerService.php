<?php

/* code generator */

namespace Review\Service;

use Picaso\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Review\Service
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
        'review'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Review',
        'app/template/default/base/review',
        'app/theme/default/sass/base/review',
        'app/theme/admin/sass/base/review',
        'static/jscript/base/review'
    ];
}