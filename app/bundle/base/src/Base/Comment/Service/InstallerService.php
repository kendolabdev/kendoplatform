<?php

/* code generator */

namespace Base\Comment\Service;

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
    protected $exportKey = 'module-base-comment';

    /**
     * @var array
     */
    protected $tableList = [
        'base_comment'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Comment',
        'app/template/default/base/Comment',
        'app/theme/default/sass/base/Comment',
        'app/theme/admin/sass/base/Comment',
        'static/jscript/base/Comment'
    ];
}