<?php

/* code generator */

namespace Comment\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Comment\Service
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
        'comment'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Comment',
        'app/template/default/base/comment',
        'app/theme/default/sass/base/comment',
        'app/theme/admin/sass/base/comment',
        'static/jscript/base/comment'
    ];
}