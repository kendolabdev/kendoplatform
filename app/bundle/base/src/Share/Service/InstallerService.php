<?php

/* code generator */

namespace Share\Service;

use Picaso\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Share\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-share';

    /**
     * @var array
     */
    protected $tableList = [
        'share'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Share',
        'app/template/default/base/share',
        'app/theme/default/sass/base/share',
        'app/theme/admin/sass/base/share',
        'static/jscript/base/share'
    ];
}