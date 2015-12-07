<?php

/* code generator */

namespace Like\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Like\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-like';

    /**
     * @var array
     */
    protected $tableList = [
        'like'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Like',
        'app/template/default/base/like',
        'app/theme/default/sass/base/like',
        'app/theme/admin/sass/base/like',
        'static/jscript/base/like'
    ];
}