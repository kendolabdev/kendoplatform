<?php

/* code generator */

namespace Base\Like\Service;

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
    protected $exportKey = 'module-base-like';

    /**
     * @var array
     */
    protected $tableList = [
        'base_like'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Like',
        'app/template/default/base/Like',
        'app/theme/default/sass/base/Like',
        'app/theme/admin/sass/base/Like',
        'static/jscript/base/Like'
    ];
}