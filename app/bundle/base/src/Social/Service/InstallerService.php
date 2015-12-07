<?php

/* code generator */

namespace Social\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Social\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-social';

    /**
     * @var array
     */
    protected $tableList = [
        'social_service'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Social',
        'app/template/default/base/social',
        'app/theme/default/sass/base/social',
        'app/theme/admin/sass/base/social',
        'static/jscript/base/social'
    ];
}