<?php

/* code generator */

namespace Link\Service;

use Picaso\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Link\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-link';

    /**
     * @var array
     */
    protected $tableList = [
        'link'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Link',
        'app/template/default/base/link',
        'app/theme/default/sass/base/link',
        'app/theme/admin/sass/base/link',
        'static/jscript/base/link'
    ];
}